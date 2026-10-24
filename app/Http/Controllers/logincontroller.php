<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->route('user_dashboard');
        }

        return back()->withErrors(['login_error' => 'ایمیل یا رمز عبور اشتباه است.']);
    }
}
