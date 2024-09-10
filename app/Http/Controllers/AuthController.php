<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the data
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        // Create a new user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
        ]);

        // Log the user in
        auth()->login($user);

        // Redirect to home page
        return redirect()->route('home');

    }

    public function login(Request $request)
    {
        // Validate the data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // If successful, redirect to home page
            return redirect()->route('home');
        }

        // If unsuccessful, redirect back to the login with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        auth()->logout();

        // Redirect to login page
        return redirect()->route('register');
    }
}
