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
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($request->only('name', 'email'));

        return back()->with('success', 'Profil utilisateur mis à jour');
    }

    public function updatePassword(Request $request)
    {
        $user = auth('web')->user();

        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Le mot de passe actuel est incorrect.');
                }
            }],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Mot de passe utilisateur mis à jour');
    }
}

