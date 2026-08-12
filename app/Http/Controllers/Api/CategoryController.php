<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('tasks')->paginate(10);

        return response()->json([
            'data' => $categories,
            'message' => 'Categorías obtenidas correctamente.',
        ]);
    }

    public function show(string $id)
    {
        $category = Category::with('tasks')->find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada.'], 404);
        }

        return response()->json([
            'data' => $category,
            'message' => 'Categoría obtenida correctamente.',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        $category = Category::create($data);

        return response()->json([
            'data' => $category->load('tasks'),
            'message' => 'Categoría creada correctamente.',
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada.'], 404);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
        ]);

        $category->update($data);

        return response()->json([
            'data' => $category->load('tasks'),
            'message' => 'Categoría actualizada correctamente.',
        ]);
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada.'], 404);
        }

        if ($category->tasks()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar la categoría porque tiene tareas asociadas.',
            ], 409);
        }

        $category->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente.']);
    }
}