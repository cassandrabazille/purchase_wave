<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function edit()
    {
        return view('profile.account', [
            'user' => auth()->user()
        ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        auth()->user()->update($request->only('name', 'email'));

        return back()->with('success', 'Profil mis à jour');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed']

        ]);
        auth()->user()->update([
            'password' => Hash::make($validated['password'])
        ]);
        return back()->with('success', 'Mot de passe mis à jour');

    }


}


