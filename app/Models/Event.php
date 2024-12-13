<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'date',
        'description',
        'price',
        'cover_image',
        'venue_image',
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Relación con el modelo Opinion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    /**
     * Formatear el precio como moneda.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Obtener la URL completa de la imagen de portada.
     *
     * @return string
     */
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image 
            ? asset('storage/' . $this->cover_image) 
            : asset('images/default_cover.jpg');
    }

    /**
     * Verifica si el evento ya ocurrió.
     *
     * @return bool
     */
    public function hasPassed()
    {
        return $this->date->isPast();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
