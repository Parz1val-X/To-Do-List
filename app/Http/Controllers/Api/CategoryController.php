<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('tasks')->get();

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
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}