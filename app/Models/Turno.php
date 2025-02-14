<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = ['cedula', 'numero_turno', 'estado', 'asesor_id'];

    public function asesor()
    {
        return $this->belongsTo(User::class, 'asesor_id');
    }
}
