<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->get();

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(TagRequest $request)
    {
        Tag::create($request->validated());

        return redirect()->route('tags.index')->with('success', 'Etiqueta creada correctamente.');
    }

    public function show(Tag $tag)
    {
        $tasks = $tag->tasks()->orderBy('created_at', 'desc')->get();

        return view('tags.show', compact('tag', 'tasks'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return redirect()->route('tags.index')->with('success', 'Etiqueta actualizada correctamente.');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->tasks()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la etiqueta porque tiene tareas asociadas.');
        }

        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Etiqueta eliminada correctamente.');
    }
}
