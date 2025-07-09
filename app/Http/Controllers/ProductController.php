<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
       {
        $products = Product::all();
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    //  Store a newly created resource in storage.


    public function store(Request $request)
    {
       $validated = $request->validate([
            'reference' => 'required|date',
            'slug' => 'required|date|after_or_equal:order_date',
            'description' => 'required|numeric|min:0',
            'price' => 'required|exists:suppliers,id',
            'image' => 'required|exists:users,id',
        ]);

        $product = Product::create([

            'reference' => $validated['reference'],
             'slug' => $validated['slug'],
            'description' => $validated['description'],
            'price' => $validated['description'],
            'image' => $validated['description'],
         
        ]);
        $product->categories()->attach($request->input('categories'));
        return redirect()->back()->with('success', 'Produit créé avec succès');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $validated['name']
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Le produit a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('products.index')
            ->with('success', 'Le produit a bien été supprimé.');

    }
}


