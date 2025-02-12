<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    protected $fillable = ['nombre', 'apellidos', 'contraseña', 'rol', 'tiquete_id'];

    // Relación con Tiquetes
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'tiquete_id');
    }
}
