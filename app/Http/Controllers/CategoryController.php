<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
      public function index(Request $request)
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
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
            'name' => 'required|string|max:255',
             'slug' => 'required|string|max:255',
        ]);

        Category::create([

            'name' => $validated['name'],
            'slug' => $validated['slug']
        ]);

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès');
    }


    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit');
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

        return redirect()->route('categories.index')
            ->with('success', 'La catégorie a bien été modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'La catégorie a bien été supprimée.');
    }
}


