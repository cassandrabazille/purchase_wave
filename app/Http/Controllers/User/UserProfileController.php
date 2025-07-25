<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserProfileController extends Controller
{
    public function edit()
    {
        $user = auth('web')->user();
        return view('user.account', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth('web')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->user_id),
            ],
        ]);

        $user->update($request->only('name', 'email'));

        return back()->with('success', 'Profil utilisateur mis à jour');
    }

 public function updatePassword(Request $request)
{
    $user = auth('web')->user();

    $request->validate([
        'current_password' => ['required', 'current_password:web'],
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user->update([
        'password' => $request->password, // pas besoin de Hash::make() si casté dans le modèle
    ]);

    return back()->with('success', 'Mot de passe utilisateur mis à jour');
}

}

