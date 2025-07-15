<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function edit(string $user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, string $user_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::findOrFail($user_id);
        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.index')->with('success', 'Profil utilisateur mis à jour');
    }

    public function destroy(string $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect()->route('admin.index')
            ->with('success', 'Le profil utilisateur a bien été supprimé.');
    }
}
