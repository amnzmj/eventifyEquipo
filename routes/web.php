<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;


// Ruta principal
// Route::get('public-events', function () {
//     return view('events.public');#temporal en lo que se mete
// });
Route::get('/', [EventController::class, 'publicList'])->name('events.public');

// Rutas de autenticación
Auth::routes();

// Rutas públicas
Route::get('public-events', [EventController::class, 'publicList'])->name('events.public');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class)->except(['index']); // Proteger todas las rutas de eventos excepto index
    Route::get('events', [EventController::class, 'index'])->name('events.index'); // Mover la ruta de index dentro del middleware
    Route::get('events/{event}/buy', [TicketController::class, 'showPurchaseForm'])->name('events.buy');
    Route::post('events/{event}/buy', [TicketController::class, 'processPurchase'])->name('events.buy.process');
    Route::get('my-purchases', [TicketController::class, 'myPurchases'])->name('my.purchases');

    // Ruta para opiniones
    Route::get('events/{event}/opinions', [EventController::class, 'opinions'])->name('events.opinions.index');
    Route::post('events/{event}/opinions', [EventController::class, 'storeOpinion'])->name('events.opinions.store');

    // Ver compradores
    Route::get('events/{event}/attendees', [TicketController::class, 'eventAttendees'])->name('events.attendees');
});

// Ruta de éxito de pago
Route::get('/payment/success', function () {
    return 'Pago completado con éxito.';
})->name('payment.success');
