<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
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

            'customer_id' =>'required',
            'total_quantity' =>'required',
            'total_amount' =>'required',
            'status' =>'required|string|max:255',
            'is_paid' =>'required|string|max:255',

        ]);



        $order = new Order();
        $order->create([
            'customer_id' => $validated['customer_id'],
            'total_quantity' => $validated['total_quantity'],
            'total_amount' => $validated['total_amount'],
           'status' => $validated['status'],
        ]);


        foreach ($request->order_items as $item) {
            OrderItem::crate([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],

            ]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
