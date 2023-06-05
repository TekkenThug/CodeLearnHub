<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Открытие обращения
     */
    public function openTicket(StoreTicketRequest $request)
    {
        Ticket::create([
            'text' => $request['text'],
            'theme' => $request['theme'],
            'email' => $request['email'],
        ]);

        return response()->json([
            'message' => 'Обращение успешно создано',
        ]);
    }
}
