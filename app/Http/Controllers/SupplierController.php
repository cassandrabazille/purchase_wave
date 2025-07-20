<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;


class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'address' => ['required', 'string', 'max:255', 'regex:/^\d+\s[\w\s\'\-]+,\s\d{5}\s[\w\s\-]+$/'],
        ], [
            'telephone.regex' => 'Le numéro de téléphone doit être au format international, exemple : +33612345678.',
            'address.regex' => 'L\'adresse doit être au format : 12 rue du Poteau, 75012 Paris.',
        ]);

        $supplier = Supplier::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'address' => $validated['address'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Fournisseur créé avec succès');
    }


    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, string $id)
    {

        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'address' => ['required', 'string', 'max:255', 'regex:/^\d+\s[\w\s\'\-]+,\s\d{5}\s[\w\s\-]+$/'],
        ], [
            'telephone.regex' => 'Le numéro de téléphone doit être au format international, exemple : +33612345678.',
            'address.regex' => 'L\'adresse doit être au format : 12 rue du Poteau, 75012 Paris.',
        ]);


        $supplier->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'address' => $validated['address'],

        ]);

        return redirect()->route('suppliers.index')
            ->with('success', 'Le fournisseur a bien été modifié.');
    }
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        // Vérifie que l'utilisateur est le créateur du fournisseur
        if ($supplier->user_id !== auth()->id()) {
            return redirect()->route('suppliers.index')
                ->withErrors(['unauthorized' => 'Vous n\'êtes pas autorisé(e) à supprimer ce fournisseur.']);
        }

        // Vérifie si ce fournisseur a des commandes associées
        if ($supplier->orders()->exists()) {
            return redirect()->route('suppliers.index')
                ->withErrors(['error' => 'Impossible de supprimer ce fournisseur car des commandes lui sont associées.']);
        }

        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Le fournisseur a bien été supprimé.');
    }



}