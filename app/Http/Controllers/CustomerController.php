<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        if(is_null($customers)){
            return response()->json([
               'message' => 'No customers found'
            ], 404);
        }


        return response()->json($customers, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' =>'required|string',
            'email' =>'required|string|email|max:255|unique:customers',
            'address' =>'required',
            'phone' =>'required',
            'city' =>'required|string',
            'country' =>'required|string',
            'state' =>'required|string'

        ]);


        $customer = new Customer;
        $customer->create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'country' => $validated['country'],
               'state' => $validated['state']
            ]);



        return response()->json(['message' => 'Customer created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if(is_null($customer)){
            return response()->json([
               'message' => 'Customer not found'
            ], 404);
        }

        return response()->json($customer, 200);
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
            'name' =>'required|string',
            'email' =>'required|string|email|max:255|unique:customers',
            'address' =>'required',
            'phone' =>'required',
            'city' =>'required|string',
            'country' =>'required|string',
           'state' =>'required|string'
        ]);


        $customer = Customer::find($id);
        if(is_null($customer)){
            return response()->json([
               'message' => 'Customer not found'
            ], 404);
        }

        $customer->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'country' => $validated['country'],
           'state' => $validated['state']
        ]);


        return response()->json(['message' =>'Customer updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if(is_null($customer)){
            return response()->json([
               'message' => 'Customer not found'
            ], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
