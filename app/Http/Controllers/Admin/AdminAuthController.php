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
        'email' => 'required|string|email|max:255',
        'password' => 'required|min:8',
    ]);

    if (\Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        return redirect()->route('admin.index')
            ->with('success', 'Connexion réussie. Bienvenue 👋');
    }

    return redirect()->back()
        ->withErrors(['email' => 'Email ou mot de passe incorrect'])
        ->withInput($request->only('email'));
}


    public function logout(Request $request)
    {
        \Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login'); // redirection login admin
    }
}
