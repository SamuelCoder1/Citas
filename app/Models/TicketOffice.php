<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketOffice extends Model
{
    protected $fillable = ['nombre', 'estado', 'tiquete_id'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticket_office_id');
    }
}

