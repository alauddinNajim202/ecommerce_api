<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' =>'required',
            'description' =>'required',
            'price' =>'required',
            'category_id' =>'required',
            'sub_category_id' =>'required',
            'quantity' =>'required'

        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->quantity = $request->quantity;
        $product->save();

        return response()->json(['message' => 'Product saved successfully'], 200);




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if(is_null($product)){
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product,200);
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
            'name' =>'required',
            'description' =>'required',
            'price' =>'required',
            'category_id' =>'required',
            'sub_category_id' =>'required',
            'quantity' =>'required'

        ]);


        $product = Product::find($id);

        if(is_null($product)){
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->quantity = $request->quantity;
        $product->save();

        return response()->json(['message' => 'Product updated successfully'], 200);




    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if(is_null($product)){
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
