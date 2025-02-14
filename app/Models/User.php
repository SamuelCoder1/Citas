<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'rol', 'documento', 'taquilla_id'];

    // ✅ Nuevo método en lugar de `can()`
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }
}
