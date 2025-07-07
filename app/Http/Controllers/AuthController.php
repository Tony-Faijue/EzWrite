<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        //validate user input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        //Hash the password
        $data['password'] = Hash::make($data['password']);
        //Create new User
        $user = User::create($data);

        //Log in new user and redirect
        Auth::login($user);
        return redirect()->intended('user.homepage');
    }
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        //validate credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //Try Authentication 
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('user.homepage');
        }
        //Failed Authentication return back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        //End the user session by logging them out
        Auth::logout();
        //Invalidate Current session
        $request->session()->invalidate();
        //Regenerate the CSRF token
        $request->session()->regenerateToken();
        //Redirect
        return redirect('/home');
    }
}
