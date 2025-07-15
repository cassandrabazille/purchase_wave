<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login'); // vue admin login, à créer si pas encore fait
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|min:4',
        ]);

        if (\Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return redirect()->back()->withErrors('Email ou mot de passe incorrect');
    }

    public function logout(Request $request)
    {
        \Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login'); // redirection login admin
    }
}
