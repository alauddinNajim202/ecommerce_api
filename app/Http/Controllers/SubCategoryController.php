<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $category_id)
    {
        $validated = $request->validate([
            'category_id' =>'required|integer',
            'name' =>'required|string|max:255',
            'quantity' =>'required|string|integer|max:255',
            'description' =>'required|string|max:255',
        ]);


        $category = Category::find($category_id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $sub_category = new SubCategory();
        $sub_category->category_id = $category_id;
        $sub_category->name = $request->name;
        $sub_category->quantity = $request->quantity;
        $sub_category->description = $request->description;
        $sub_category->save();


        return response()->json(['message' => 'Sub Category created successfully'], 202);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, $category_id)
    {
        $sub_category = SubCategory::where('category_id', $category_id)->find($id);

        if (is_null($sub_category)) {
            return response()->json(['message' => 'Sub Category not found'], 404);
        }

        return response()->json($sub_category, 200);
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
    public function update(Request $request, string $id, $category_id)
    {
        $validated = $request->validate([
            // 'category_id' =>'required|integer',
            'name' =>'required|string|max:255',
            'quantity' =>'required|string|integer|max:255',
            'description' =>'required|string|max:255',
        ]);


        $sub_category = SubCategory::where('category_id', $category_id)->find($id);

        if (!$sub_category) {
            return response()->json(['message' => 'Sub Category not found'], 404);
        }

        // $sub_category = new SubCategory();
        $sub_category->update(
            [
                'category_id' => $category_id,
                'name' => $request->name,
                'quantity' => $request->quantity,
                'description' => $request->description,
            ]
        );


        return response()->json(['message' => 'Sub Category updated successfully'], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $category_id)
    {
        $sub_category = SubCategory::where('category_id', $category_id)->find($id);

        if (is_null($sub_category)) {
            return response()->json(['message' => 'Sub Category not found'], 404);
        }

        $sub_category->delete();

        return response()->json(['message' => 'Sub Category deleted successfully'], 202);
    }
}
