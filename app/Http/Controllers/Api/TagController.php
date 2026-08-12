<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('tasks')->paginate(10);

        return response()->json([
            'data' => $tags,
        ]);
    }

    public function show(string $id)
    {
        $tag = Tag::with('tasks')->find($id);

        if (!$tag) {
            return response()->json(['message' => 'Etiqueta no encontrada.'], 404);
        }

        return response()->json([
            'data' => $tag,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
        ]);

        $tag = Tag::create($data);

        return response()->json([
            'data' => $tag->load('tasks'),
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json(['message' => 'Etiqueta no encontrada.'], 404);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name,' . $tag->id],
        ]);

        $tag->update($data);

        return response()->json([
            'data' => $tag->load('tasks'),
        ]);
    }

    public function destroy(string $id)
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json(['message' => 'Etiqueta no encontrada.'], 404);
        }

        if ($tag->tasks()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar la etiqueta porque tiene tareas asociadas.',
            ], 409);
        }

        $tag->delete();

        return response()->json(null, 204);
    }
}