<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Constructor to apply the guest middleware except for the logout method
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the login request
        $this->validateLogin($request);

        // Attempt to log the user in
        if (Auth::attempt($this->credentials($request))) {
            // Redirect to intended page
            return redirect()->intended('dashboard');
        }

        // If authentication fails, redirect back with errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Validate the login request
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    }

    // Get the credentials from the request and sanitize them
    protected function credentials(Request $request)
    {
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $password = $request->password;

        return ['email' => $email, 'password' => $password];
    }

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
