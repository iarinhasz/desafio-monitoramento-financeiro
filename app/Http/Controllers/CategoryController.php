<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validade([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::create([
            'name' => $validated['name'],
        ]);

        return response()->json($category, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'categoria excluida!']);
    }
}
