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
        ]);
    }

    public function show(string $id)
    {
        $category = Category::with('tasks')->findOrFail($id);

        return response()->json([
            'data' => $category,
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
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
        ]);

        $category->update($data);

        return response()->json([
            'data' => $category->load('tasks'),
        ]);
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->tasks()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar la categoría porque tiene tareas asociadas.',
            ], 409);
        }

        $category->delete();

        return response()->json(null, 204);
    }
}