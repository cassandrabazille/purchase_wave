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
            'telephone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);


        $supplier = Supplier::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'address' => $validated['address'],
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
            'telephone' => 'required|string|max:255',
            'address' => 'required|string|max:255',

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
        $supplier->delete();
        return redirect()->route('suppliers.index')
            ->with('success', 'Le fournisseur a bien été supprimé.');
    }

}
