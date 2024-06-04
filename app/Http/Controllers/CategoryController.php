<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate name and description
        $validated = $request->validate([
            'name' =>'required|string|max:255',
            'description' =>'required|string|max:255',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json(['message' => "Category created successfully"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'name' =>'required|string|max:255',
            'description' =>'required|string|max:255',
        ]);


        $category = Category::find($id);

        if(is_null($category)){
            return response()->json(['message' => "Category not found"], 404);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json(['message' => "Category updated successfully"], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(is_null($category)){
            return response()->json(['message' => "Category not found"], 404);
        }

        $category->delete();

        return response()->json(['message' => "Category deleted successfully"], 200);
    }
}
