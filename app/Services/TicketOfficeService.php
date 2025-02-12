<?php

namespace App\Services;

use App\Models\TicketOffice;

class TicketOfficeService
{
    public function createTicketOffice($data)
    {
        return TicketOffice::create($data);
    }

    public function getAvailableTicketOffice()
    {
        return TicketOffice::where('estado', 'libre')->first();
    }

    public function updateTicketOfficeStatus($id, $status)
    {
        $taquilla = TicketOffice::findOrFail($id);
        $taquilla->update(['estado' => $status]);

        return $taquilla;
    }
}
