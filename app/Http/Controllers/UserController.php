<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(Auth::attempt($validated)) {
            if(Auth::user()->is_admin) {
                // return redirect()->route('home');
                return redirect()->route('admin.admin.index');
            }
        }
        return redirect()->back()->with('error', 'Incorrect email or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
