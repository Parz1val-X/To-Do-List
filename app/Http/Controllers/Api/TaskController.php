<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->get();

        return response()->json([
            'data' => $tasks,
            'message' => 'Tareas obtenidas correctamente.',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'completed' => ['sometimes', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $data['completed'] = $data['completed'] ?? false;

        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $task = Task::create($data);
        $task->tags()->sync($tags);
        $task->load(['category', 'tags']);

        return response()->json([
            'data' => $task,
            'message' => 'Tarea creada correctamente.',
        ], 201);
    }

    public function show(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}