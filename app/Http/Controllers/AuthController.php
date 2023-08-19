<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('adminDashboard');
        }
        return redirect()->back()->withError('Wrong Credentials');
        
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginForm');
    }
}
