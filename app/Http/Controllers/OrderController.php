<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ProductController;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\ShowCommand;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
       
        $users = User::all();
        $suppliers = Supplier::all();

        $ordersQuery = Order::with(['user', 'supplier']);

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

        $orders= $ordersQuery->get();

        return view('orders.index', compact('orders', 'suppliers', 'users'));
    }

    public function create()
    {
        $users = User::all();
        $suppliers = Supplier::select(['id', 'name'])->orderBy('name')->get();
        return view('orders.create', compact('users', 'suppliers'));

    }

    public function show($id)
    {
        $order = Order::with('supplier')->findOrFail($id);
        $orderitems = $order->orderItems()->with('product')->get();
       
        return view('orders.show', compact('order', 'orderitems'));
    }

    public function store(Request $request)
    {
 

        $validated = $request->validate([
            'expected_delivery_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);


        $order = Order::create([
            'order_date' => now(),
            'expected_delivery_date' => $validated['expected_delivery_date'],
            'confirmed_delivery_date' => null,
            'status' => 'pending',
            'order_amount' => 0,
            'supplier_id' => $validated['supplier_id'],
            'user_id' => auth()->id(),
        ]);

            $orderDate=Carbon::parse($order->order_date);
        $expectedDate = Carbon::parse($validated['expected_delivery_date']);
      

        if ($expectedDate->lt($orderDate)) {

            return back()->withErrors(['expected_delivery_date' => 'La date de livraison doit être postérieure ou égale à la date de commande'])->withInput();

        }

        return redirect()->route('orderitems.create', ['order_id' =>$order->id])->with('success', 'Commande créée avec succès');
    }

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $orders = Order::all();
        $users = User::all();
        $suppliers = Supplier::orderBy('name')->get();
        return view('orders.edit', compact('order', 'orders', 'users', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'confirmed_delivery_date' => 'nullable|date',
            'status' => 'required|in:pending,confirmed,shipped,cancelled',
        ]);

    
    
        $order->update([
            'confirmed_delivery_date' => $validated['confirmed_delivery_date'] ?? null,
            'status' => $validated['status'],
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

