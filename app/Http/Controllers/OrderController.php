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
        $order = Order::with('orderItems')->get();

        if(is_null($order)){
            return response()->json(['message' => 'No orders found'], 404);
        };

        return response()->json($order, 200);
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
        // Validate request data
        $validated = $request->validate([
            'customer_id' => 'required',
            'total_quantity' => 'required',
            'total_amount' => 'required',
            'status' => 'required|string|max:255',
            'is_paid' => 'required|string|max:255',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|integer',
            'order_items.*.quantity' => 'required|integer',
            'order_items.*.price' => 'required|numeric'
        ]);

        // Create a new order
        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'total_quantity' => $validated['total_quantity'],
            'total_amount' => $validated['total_amount'],
            'status' => $validated['status'],
            'is_paid' => $validated['is_paid'],
        ]);

        // Create order items
        foreach ($validated['order_items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Order saved successfully', 'order' => $order->load('orderItems')], 201);
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
        // Find the order by id
        $order = Order::find($id);

        // Update the order
        $order->update([
            'customer_id' => $request->customer_id,
            'total_quantity' => $request->total_quantity,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
            'is_paid' => $request->is_paid,
        ]);


        $orderItems = $request->order_items;


        foreach ($orderItems as $item) {

            $orderItem = OrderItem::where('order_id', $order->id)
                                  ->where('product_id', $item['product_id'])
                                  ->first();


            if ($orderItem) {
                $orderItem->update([
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            } else {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }


        return response()->json(['message' => 'Order updated successfully'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::with('orderItems')->find($id);

        $order->orderItems()->delete();
        $order->delete();


        return response()->json(['message' => 'Order deleted successfully'], 200);

    }
}
