<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'tags'])->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('tasks.create', compact('categories', 'tags'));
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['completed'] = $request->has('completed');

        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $task = Task::create($data);
        $task->tags()->sync($tags);

        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente.');
    }

    public function show(Task $task)
    {
        $task->load(['category', 'tags']);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('tasks.edit', compact('task', 'categories', 'tags'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $data['completed'] = $request->has('completed');

        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $task->update($data);
        $task->tags()->sync($tags);

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Task $task)
    {
        $task->tags()->detach();
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }
}