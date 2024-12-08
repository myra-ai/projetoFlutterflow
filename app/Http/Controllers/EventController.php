<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Log;


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
            'valor' => 'required|numeric|min:0', 
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
    try {
        // Log inicial para depuração
        Log::info('Iniciando atualização do evento', [
            'id' => $id,
            'request_data' => $request->all(),
        ]);

        // Verifica se o ID fornecido é válido
        if (!is_numeric($id)) {
            Log::error('ID inválido fornecido', ['id' => $id]);
            return response()->json(['message' => 'ID inválido fornecido.'], 400);
        }

        // Busca o evento pelo ID
        Log::info('Tentando buscar evento pelo ID', ['id' => $id]);
        $event = Event::find($id);

        if (!$event) {
            Log::error('Evento não encontrado', ['id' => $id]);
            return response()->json(['message' => 'Evento não encontrado!'], 404);
        }

        // Log do evento encontrado
        Log::info('Evento encontrado com sucesso', [
            'event_id' => $event->id,
            'event_data' => $event->toArray(),
        ]);

        // Validação dos dados recebidos
        Log::info('Iniciando validação dos dados recebidos', ['data' => $request->all()]);
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
            'image' => 'sometimes|string',
            'details' => 'sometimes|string',
            'valor' => 'sometimes|numeric|min:0',
        ]);

        // Verificação adicional para 'date'
        if ($request->has('date')) {
            $date = $request->input('date');
            if (strtotime($date) < strtotime(now())) {
                Log::error('A data fornecida está no passado', ['date' => $date]);
                return response()->json(['message' => 'A data fornecida não pode estar no passado.'], 422);
            }
        }

        // Verificação adicional para 'image'
        if ($request->has('image')) {
            $image = $request->input('image');
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                Log::error('A imagem fornecida não é uma URL válida', ['image' => $image]);
                return response()->json(['message' => 'A imagem fornecida não é uma URL válida.'], 422);
            }

            // Verifica se a URL da imagem está acessível
            $headers = @get_headers($image);
            if (!$headers || strpos($headers[0], '200') === false) {
                Log::error('A URL da imagem não está acessível', ['image' => $image]);
                return response()->json(['message' => 'A URL da imagem não está acessível.'], 422);
            }
        }

        // Log dos dados validados
        Log::info('Dados validados com sucesso', ['validated_data' => $validatedData]);

        // Atualiza o evento com os dados fornecidos
        Log::info('Iniciando atualização do evento no banco de dados');
        $event->update($validatedData);

        // Log após atualização
        Log::info('Evento atualizado com sucesso', [
            'updated_event_id' => $event->id,
            'updated_event_data' => $event->toArray(),
        ]);

        return response()->json(['message' => 'Evento atualizado com sucesso!', 'event' => $event]);
    } catch (\Illuminate\Validation\ValidationException $validationException) {
        // Log de erros de validação
        Log::warning('Erro de validação ao atualizar evento', [
            'errors' => $validationException->errors(),
            'input' => $request->all(),
        ]);
        return response()->json(['message' => 'Erro de validação.', 'errors' => $validationException->errors()], 422);
    } catch (\Exception $e) {
        // Captura e log de erros inesperados
        Log::error('Erro ao atualizar o evento', [
            'error_message' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->json(['message' => 'Erro ao atualizar o evento.', 'error' => $e->getMessage()], 500);
    }
}



        /**
     * Deletar um evento existente.
     */
    public function destroy($id)
    {
        // Busca o evento pelo ID
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado!'], 404);
        }

        // Deleta o evento
        $event->delete();

        return response()->json(['message' => 'Evento deletado com sucesso!']);
    }

}