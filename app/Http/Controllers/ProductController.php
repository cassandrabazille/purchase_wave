<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $product = Product::with('user')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'category_id' => 'required|exists:categories,id',
        ]);




        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('products', $imageName, 'public');


        Product::create([
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => 'products/' . $imageName,
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
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


         if ($product->user_id !== auth()->id()) {
        return redirect()->route('products.index')
            ->withErrors(['unauthorized' => 'Vous n\'êtes pas autorisé(e) à modifier ce produit.']);
    }


        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $imagePath = $product->image; // Garder l'ancienne image par défaut

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('products', $imageName, 'public');

            // Supprimer l'ancienne image du disque si elle existe
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = 'products/' . $imageName;
        }

        $product->update([
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
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

    // Vérification que l'utilisateur connecté est bien le créateur du produit
    if ($product->user_id !== auth()->id()) {
        return redirect()->route('products.index')
            ->withErrors(['unauthorized' => 'Vous n\'êtes pas autorisé(e) à supprimer ce produit.']);
    }

    // Vérifie si ce produit est utilisé dans des commandes (order_items par exemple)
    if ($product->orderItems()->exists()) {
        return redirect()->route('products.index')
            ->withErrors(['error' => 'Impossible de supprimer ce produit car il est utilisé dans des commandes.']);
    }

    $product->delete();

    return redirect()->route('products.index')
        ->with('success', 'Le produit a bien été supprimé.');
}

}


