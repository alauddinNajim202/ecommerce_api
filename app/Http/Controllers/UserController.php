<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        if(is_null($users)){
            return response()->json(['message'=> 'No users found'], 404 );
        }

        return response()->json($users, 200);
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
            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email','max:255', 'unique:users'],
            'password' => ['required','string'],

        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password =  md5($validated['password']);
        $user->save();

        return response()->json(['message'=> 'User created successfully'], 200 );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return response()->json(['message'=> 'User not found'], 404 );
        }

        return response()->json($user, 200);
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
            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email','max:255', 'unique:users'],
            'password' => ['required','string'],

        ]);

        $user = User::find($id);

        if(is_null($user)){
            return response()->json(['message'=> 'User not found'], 404 );
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password =  md5($validated['password']);
        $user->save();

        return response()->json(['message'=> 'User updated successfully'], 200 );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return response()->json(['message'=> 'User not found'], 200);
        }

        $user->delete();

        return response()->json(['message'=> 'User deleted successfully'], 200);
    }
}
