<?php

namespace App\Http\Controllers;

use Illuminate\Database\Console\ShowCommand;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Supplier;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        $suppliers = Supplier::all();
        $selectedUser = null;
        $selectedSupplier = null;

        $ordersQuery = Order::query();

        // Filter by user
        if ($request->has('user')) {
            $selectedUser = User::with('order')->find($request->input('user'));

            if ($selectedUser) {
                $orders = $selectedUser->orders;
            }
        }

        // Filter by supplier

        if ($request->has('supplier')) {
            $selectedSupplier = Supplier::with('order')->find($request->input('supplier'));

            if ($selectedSupplier) {
                $orders = $selectedSupplier->orders;
            }
        }
        $orders = $ordersQuery->get();
        return view('orders.index', compact('orders', 'suppliers', 'selectedSupplier'));
    }

    public function create()
    {
        $users = User::all();
        $suppliers = Supplier::orderBy('name')->get();
        return view('orders.create', compact('users', 'suppliers'));

    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date|after_or_equal:order_date',
            'order_amount' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $order = Order::create([

            'order_date' => $validated['order_date'],
            'expected_delivery_date' => $validated['expected_delivery_date'],
            'confirmed_delivery_date' => null,
            'status' => 'pending',
            'order_amount' => $validated['order_amount'],
            'supplier_id' => $validated['supplier_id'],
            'user_id' => $validated['user_id'],
        ]);

        $order->update(['reference' => 'ORD-' . $order->id]);
        return redirect()->back()->with('success', 'Commande créée avec succès');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     $tache = Taches::with('categorie')->findOrFail($id);
    //     return view('taches.show', compact('tache'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     $tache = Taches::find($id);
    //     $categories = Categorie::all();
    //     return view('taches.edit', compact('tache', 'categories'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'titre' => 'required',
    //         'id_categorie' => 'required'
    //     ]);
    //     $tache = Taches::findOrFail($id);
    //     $tache->update([
    //         'titre' => $request->input('titre'),
    //     ]);

    //     return redirect()->route('taches.index')
    //         ->with('success', 'La tâche a bien été modifiée.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     $tache = Taches::find($id);
    //     $tache->delete();
    //     return redirect()->route('taches.index')
    //         ->with('success', 'La tâche a bien été supprimée.');
    // }
}

