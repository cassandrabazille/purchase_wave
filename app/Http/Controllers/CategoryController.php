<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));  // compact sert à passer à la vue index la variable $categories pour qu'elle soit disponible dans blade

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'required|string|max:1000'
        ]);

        $slug = Str::slug($validated['name']);

        if (Category::where('slug', $slug)->exists()) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'Une catégorie avec un slug similaire existe déjà.']);
        }


        Category::create([

            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès');
    }


    public function show(string $id)
    {
        $category = Category::with('user')->findOrFail($id);
        return view('categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $category = Category::findOrFail($id);

       
         if ($category->user_id !== auth()->id()) {
        return redirect()->route('categories.index')
            ->withErrors(['unauthorized' => 'Vous n\'êtes pas autorisé(e) à modifier cette catégorie.']);
    }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000'
        ]);

        $slug = Str::slug($validated['name']);

        $slugExists = Category::where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->exists();

        if ($slugExists) {

            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'Une catégorie avec un slug similaire existe déjà.']);
        }

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description']
        ]);



        return redirect()->route('categories.index')
            ->with('success', 'La catégorie a bien été modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $category = Category::findOrFail($id);

    // Vérifie que l'utilisateur est le créateur de la catégorie
    if ($category->user_id !== auth()->id()) {
        return redirect()->route('categories.index')
            ->withErrors(['unauthorized' => 'Vous n\'êtes pas autorisé(e) à supprimer cette catégorie.']);
    }

    // Vérifie si des produits sont liés à cette catégorie
    if ($category->products()->exists()) {
        return redirect()->route('categories.index')
            ->withErrors(['error' => 'Impossible de supprimer cette catégorie car des produits y sont associés.']);
    }

    $category->delete();

    return redirect()->route('categories.index')
        ->with('success', 'La catégorie a bien été supprimée.');
}

}


