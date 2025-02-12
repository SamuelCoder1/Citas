<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['numero', 'estado', 'user_id', 'ticket_office_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticketOffice()
    {
        return $this->belongsTo(TicketOffice::class, 'ticket_office_id');
    }
}

