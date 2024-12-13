<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;

class TicketController extends Controller
{
    /**
     * Muestra el formulario de compra de boletos.
     *
     * @param int $eventId
     * @return \Illuminate\View\View
     */
    public function showPurchaseForm($eventId)
    {
        $event = Event::findOrFail($eventId);

        return view('tickets.buy', ['event' => $event]);
    }

    /**
     * Procesa la compra de boletos.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPurchase(Request $request, Event $event)
    {
        // Configura la clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Validación de los datos del formulario
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        try {
            // Crea una intención de pago
            $paymentIntent = PaymentIntent::create([
                'amount' => $event->price * $request->quantity * 100, // Convertir a centavos
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'confirmation_method' => 'manual', // Confirmación manual
                'confirm' => true,
                'return_url' => route('payment.success'), // Configura la URL de retorno
            ]);

            // Maneja el estado del PaymentIntent
            if ($paymentIntent->status === 'succeeded') {
                $ticket = Ticket::create([
                    'user_id' => auth()->id(),
                    'event_id' => $event->id,
                    'quantity' => $request->quantity,
                    'payment_intent_id' => $paymentIntent->id,
                    'total_price' => $event->price * $request->quantity,
                    'status' => 'completed',
                ]);

                // Enviar correo de confirmación
                \Mail::to(auth()->user()->email)->send(new \App\Mail\TicketPurchaseConfirmation($ticket));
                return redirect()->route('my.purchases')->with('success', '¡Compra realizada con éxito!');
            } elseif ($paymentIntent->status === 'requires_action') {
                return redirect($paymentIntent->next_action->redirect_to_url->url); // Redirige al usuario si es necesario
            } else {
                return back()->with('error', 'El pago no fue exitoso. Estado: ' . $paymentIntent->status);
            }
        } catch (ApiErrorException $e) {
            return back()->with('error', 'Hubo un problema con tu compra: ' . $e->getMessage());
        }   catch (\Stripe\Exception\CardException $e) {
            return back()->with('error', 'Error con la tarjeta: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }




    /**
     * Muestra el historial de compras del usuario.
     *
     * @return \Illuminate\View\View
     */
    public function myPurchases()
    {
        $tickets = Ticket::where('user_id', auth()->id())->with('event')->get();

        return view('tickets.purchases', ['tickets' => $tickets]);
    }

    public function eventAttendees($eventId)
    {
        $event = Event::findOrFail($eventId);

        // Obtén los tickets relacionados con el evento, incluyendo la información de los usuarios
        $attendees = Ticket::where('event_id', $eventId)->with('user')->get();

        return view('events.attendees', ['event' => $event, 'attendees' => $attendees]);
    }

}
