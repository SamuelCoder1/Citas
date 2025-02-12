<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    // Los pacientes piden un turno
    public function requestTicket(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Se obtiene la taquilla libre
        $ticketOffice = $this->ticketService->getAvailableTicketOffice();

        if (!$ticketOffice) {
            return response()->json(['message' => 'No hay taquillas disponibles'], 404);
        }

        // Se crea un tiquete para el usuario
        $ticket = $this->ticketService->createTicket($validated['user_id'], $ticketOffice->id);

        return response()->json(['ticket' => $ticket], 201);
    }

    // Actualizar el estado de un tiquete
    public function updateTicketStatus($ticketId, Request $request)
    {
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,en proceso,finalizado,cancelado',
        ]);

        $ticket = $this->ticketService->updateTicketStatus($ticketId, $validated['estado']);

        return response()->json(['ticket' => $ticket], 200);
    }
}
