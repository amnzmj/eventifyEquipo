<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'opinion',
        'rating',
    ];


    // Relación con el modelo Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
