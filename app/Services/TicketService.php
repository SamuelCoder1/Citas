<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    public function createTicket($userId, $taquillaId)
    {
        return Ticket::create([
            'numero' => rand(1000, 9999), // Genera un número aleatorio para el tiquete
            'estado' => 'pendiente',
            'user_id' => $userId,
            'taquilla_id' => $taquillaId,
        ]);
    }

    public function updateTicketStatus($ticketId, $status)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $ticket->update(['estado' => $status]);

        return $ticket;
    }
}
