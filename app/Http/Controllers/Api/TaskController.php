<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->paginate(10);

        return response()->json([
            'data' => $tasks,
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
        ], 201);
    }

    public function show(string $id)
    {
        $task = Task::with(['category', 'tags'])->find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada.'], 404);
        }

        return response()->json([
            'data' => $task,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada.'], 404);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'completed' => ['sometimes', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        if (!array_key_exists('completed', $data)) {
            $data['completed'] = $task->completed;
        }

        $task->update($data);
        $task->tags()->sync($tags);
        $task->load(['category', 'tags']);

        return response()->json([
            'data' => $task,
        ]);
    }

    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada.'], 404);
        }

        $task->tags()->detach();
        $task->delete();

        return response()->json(null, 204);
    }
}