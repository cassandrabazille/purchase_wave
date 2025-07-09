<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        return view('products.index', compact('products'));
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

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);


        $product = Product::create([
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $validated['image'],
            'category_id' => $validated['category_id']
        ]);

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product->update([
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $validated['image'],
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Le produit a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Le produit a bien été supprimé.');
    }
}


