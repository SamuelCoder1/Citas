<?php

namespace App\Http\Controllers;

use App\Services\TicketOfficeService;
use Illuminate\Http\Request;

class TicketOfficeController extends Controller
{
    protected $ticketOfficeService;

    public function __construct(TicketOfficeService $ticketOfficeService)
    {
        $this->ticketOfficeService = $ticketOfficeService;
    }
    
    public function createTicketOffice(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'estado' => 'required|in:libre,ocupado,cerrada',
        ]);

        $ticketOffice = $this->ticketOfficeService->createTicketOffice($validated);

        return response()->json(['ticket_office' => $ticketOffice], 201);
    }

    public function getAvailableTicketOffice()
    {
        $ticketOffice = $this->ticketOfficeService->getAvailableTicketOffice();

        if ($ticketOffice) {
            return response()->json(['ticket_office' => $ticketOffice], 200);
        }

        return response()->json(['message' => 'No hay taquillas disponibles'], 404);
    }

    public function updateTicketOfficeStatus($id, Request $request)
    {
        $validated = $request->validate([
            'estado' => 'required|in:libre,ocupado,cerrada',
        ]);

        $ticketOffice = $this->ticketOfficeService->updateTicketOfficeStatus($id, $validated['estado']);

        return response()->json(['ticket_office' => $ticketOffice], 200);
    }
}
