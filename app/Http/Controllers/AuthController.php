<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the form datas
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6',
        ]);
        // Create a new user
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // // Log the user in
        Auth::login($user);

        // Redirect the user to the home page
        // return redirect('/');
        return redirect('/');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt($validatedData)) {
            // If login is successful, redirect to the home page
            return redirect('/');
        } else {
            // If login is unsuccessful, redirect back to the login page with an error message
            return redirect('/login')->with('error', 'Invalid credentials. Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
