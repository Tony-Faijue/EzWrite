<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Log;

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
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'repassword' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        //Check if password does not match the confirmed password for security
        try {
            if ($data['password'] != $data['repassword']) {
                throw new Exception();
            }
        } catch (Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return redirect()->route('register')
                ->withErrors(['registration' => 'Registration failed, password does not match, please try again.'])
                ->withInput();
        }

        //Hash the password
        $data['password'] = Hash::make($data['password']);

        //Create new User
        try {
            $user = User::create($data);
        } catch (Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return redirect()->route('register')
                ->withErrors(['registration' => 'Registration failed, please try again.'])
                ->withInput();
        }

        //Log in new user and redirect them
        Auth::login($user);
        return redirect()->route('user-home')->with('Success', "Welcome aboard!");
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
            'login' => 'The provided credentials do not match our records.',
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
