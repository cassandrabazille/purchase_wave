<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class UserAuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        \Auth::guard('web')->login($user);
    $request->session()->regenerate();

    return redirect()->route('dashboard.index')->with('success', 'Inscription réussie. Bienvenue 👋');
}

    

    public function showLogin()
    {
        return view('auth.login');
    }

public function doLogin(Request $request)
{
    $request->validate([
        'email' => 'required|string|max:255',
        'password' => 'required|min:8',
    ]);

    if (\Auth::guard('web')->attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect()->route('dashboard.index')->with('success', 'Connexion réussie. Bienvenue 👋');
    }

    // Si on arrive ici, la connexion a échoué
    return back()->withErrors([
        'email' => 'Mauvaise adresse ou mot de passe.',
    ])->withInput($request->only('email'));
}



    public function logout(Request $request)
    {
        \Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
