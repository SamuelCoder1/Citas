<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketOfficeController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::post('/login', [AuthController::class, 'login']);

// Rutas de usuarios (empleados)
Route::post('/employees', [UserController::class, 'storeEmployee']);

// Rutas de tickets
Route::post('/tickets', [TicketController::class, 'requestTicket']);
Route::put('/tickets/{ticketId}', [TicketController::class, 'updateTicketStatus']);

// Rutas de taquillas (ticket offices)
Route::post('/ticket-offices', [TicketOfficeController::class, 'createTicketOffice']);
Route::get('/ticket-offices/available', [TicketOfficeController::class, 'getAvailableTicketOffice']);
Route::put('/ticket-offices/{id}', [TicketOfficeController::class, 'updateTicketOfficeStatus']);
