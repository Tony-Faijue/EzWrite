<?php

namespace App\Http\Controllers;

use Exception;
use Log;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $id = auth()->id();
        return view('user.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
        $id = auth()->id();
        return view('user.update-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //Get the authenticated user
        $user = auth()->user();

        //Validate the inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            //ignore the current user id
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ]);


        $updateData = [
            'name' => $validated['name'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
        ];

        //Hash and update the password if it is provided
        if ($request->filled('password')) {
            //Hash the password
            $updateData['password'] = Hash::make($validated['password']);
        }

        //Update the user
        $user->update($updateData);


        return redirect()->route('user-home')->with('Success', "User Updated Successfully!");
    }

}
