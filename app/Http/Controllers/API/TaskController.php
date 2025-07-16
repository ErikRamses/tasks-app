<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('limit', 10);
        $offset = $request->input('offset', 0);

        $tasks = Task::paginate($perPage, ['*'], 'page', $offset);
        return $this->getResponseJSON(200, new TaskCollection($tasks));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'completada' => 'required|boolean',
            'fecha_limite' => 'nullable|date',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no debe exceder los 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',
            'completada.required' => 'El estado es obligatorio.',
            'completada.boolean' => 'El estado debe ser booleano.',
            'fecha_limite.date' => 'La fecha de límite debe ser una fecha válida.',
        ]);

        if ($validator->fails()) {
            return $this->getErrorResponseJSON(422, 'Error de validación', $validator->errors());
        }

        $task = Task::create($request->all());
        return $this->getResponseJSON(201, new TaskResource($task));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return $this->getErrorResponseJSON(404, 'Tarea no encontrada');
        }
        return $this->getResponseJSON(200, new TaskResource($task));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return $this->getErrorResponseJSON(404, 'Tarea no encontrada');
        }
        $task->update($request->all());
        return $this->getResponseJSON(200, new TaskResource($task));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return $this->getErrorResponseJSON(404, 'Tarea no encontrada');
        }
        $task->delete();
        return $this->getResponseJSON(200, new TaskResource($task));
    }
}
