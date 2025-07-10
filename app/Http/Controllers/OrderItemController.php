<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{

    public function index(Request $request)
    {
        $orderitems = OrderItem::all();
        return view('orderitems.index', compact('orderitems'));
    }
    public function create()
    {
        $orders = Order::all();
        $products = Product::all();

        return view('orderitems.create', compact('orders', 'products'));

    }

    public function show(string $id)
    {
        $orderitem = OrderItem::findOrFail($id);
        return view('orderitems.show', compact('orderitem'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'line_total' => 'required|numeric|min:0',

        ]);


        $orderitem = OrderItem::create([
            'order_id' => $validated['order_id'],
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'line_total' => $validated['line_total'],
        ]);

        return redirect()->route('orderitems.index')->with('success', 'Ligne de commande créée avec succès');
    }

    public function edit(string $id)
    {
        $orderitem = OrderItem::findOrFail($id);
        $orders = Order::all();
        $products = Product::all();
        return view('orderitems.edit', compact('orderitem','orders','products'));
    }

    public function update(Request $request, string $id)
    {

        $orderitem = OrderItem::findOrFail($id);

        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'line_total' => 'required|numeric|min:0',

        ]);

        $orderitem->update([
            'order_id' => $validated['order_id'],
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'line_total' => $validated['line_total'],

        ]);

        return redirect()->route('orderitems.index')
            ->with('success', 'La ligne de commande a bien été modifiée.');
    }
    public function destroy(string $id)
    {
        $orderitem = OrderItem::findOrFail($id);
        $orderitem->delete();
        return redirect()->route('orderitems.index')
            ->with('success', 'La ligne de commande a bien été supprimée.');

    }


}
