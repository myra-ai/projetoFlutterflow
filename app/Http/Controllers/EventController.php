<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    /**
     * Listar todos os eventos.
     */
    public function index()
    {
        // Busca todos os eventos no banco de dados
        $events = Event::all();
        return response()->json($events);
    }

    /**
     * Criar um novo evento.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'required|string',
            'details' => 'required|string',
        ]);

        // Criação do evento
        $event = Event::create($validatedData);

        return response()->json(['message' => 'Evento criado com sucesso!', 'event' => $event], 201);
    }

    /**
     * Editar um evento existente.
     */
    public function update(Request $request, $id)
    {
        // Busca o evento pelo ID
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado!'], 404);
        }

        // Validação dos dados
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
            'image' => 'sometimes|string',
            'details' => 'sometimes|string',
        ]);

        // Atualiza o evento com os dados fornecidos
        $event->update($validatedData);

        return response()->json(['message' => 'Evento atualizado com sucesso!', 'event' => $event]);
    }
}