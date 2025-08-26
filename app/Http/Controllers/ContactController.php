<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function submit(Request $request)
    {
        //Validate the Contactform data
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:50',
            'message' => 'required|string|max:750',
        ]);

        //here would handle sending the email

        return redirect()->route('home')->with('Success', 'Message Has Been Sent!');
    }
    public function show()
    {
        return view('contact-form');
    }

}
