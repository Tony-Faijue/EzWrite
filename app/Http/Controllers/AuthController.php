<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Returns the Register Form View
     * @return \Illuminate\Contracts\View\View
     */
    public function showRegister()
    {
        return view('auth.register');
    }
    /**
     * Validates the $request to create a new user
     * and redirects to user homepage view
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        //Log in new user and redirect them
        Auth::login($user);
        return redirect()->route('user-home');
    }
    /**
     * Returns the view to Login Form
     * @return \Illuminate\Contracts\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }
    /**
     * Validates the $request then tries to authenticate the user and redirects them to user homepage view,
     * Otherwise failed authentication returns error message
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        //validate input data from $request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Try Authentication with the Auth class and the attempt function
        //Attempt to log in
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            //Prevent session fixation by getting a fresh session ID
            $request->session()->regenerate();
            //Redirected to guarded route
            return redirect()->route('user-home');
        }
        //Failed Authentication return back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    /**
     * Ends the current user session and redirects them to the home page
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        //End the user session by logging them out the application
        Auth::logout();
        //Invalidate Current session by clearing all session data
        $request->session()->invalidate();
        //Regenerate the CSRF token for the new session
        $request->session()->regenerateToken();
        //Redirect to home page
        return redirect('/home');
    }
}
