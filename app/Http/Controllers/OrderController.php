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
        $orders= Order::all();
        $users = User::all();
        $suppliers = Supplier::all();
        $selectedUser = null;
        $selectedSupplier = null;

        $ordersQuery = Order::with(['user','supplier']);

        // Filter by user
        if ($request->has('user')) {
            $selectedUser = User::find($request->input('user'));

            if ($selectedUser) {
                $ordersQuery->where('user_id', $selectedUser->id);
            }
        }

        // Filter by supplier

        if ($request->has('supplier')) {
        $selectedSupplier = Supplier::find($request->input('supplier'));
        if ($selectedSupplier) {
            $ordersQuery->where('supplier_id', $selectedSupplier->id);
        }
    }
     
        return view('orders.index', compact('orders','suppliers', 'users'));
    }

    public function create()
    {
        $users = User::all();
        $suppliers = Supplier::select(['id','name'])->orderBy('name')->get();
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

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        $suppliers = Supplier::orderBy('name')->get();
        return view('orders.edit', compact('order', 'users', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date|after_or_equal:order_date',
            'order_amount' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $order = Order::findOrFail($id);

        $order->update([
            'order_date' => $validated['order_date'],
            'expected_delivery_date' => $validated['expected_delivery_date'],
            'confirmed_delivery_date' => null,
            'status' => 'pending',
            'order_amount' => $validated['order_amount'],
            'supplier_id' => $validated['supplier_id'],
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'La commande a bien été modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success', 'La commande a bien été supprimée.');

    }
}

