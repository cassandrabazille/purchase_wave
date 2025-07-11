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
        $order = Order::findOrFail(request('order_id'));
        $products = Product::all();

        return view('orderitems.create', compact('order', 'products'));

    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $orderitem = OrderItem::findOrFail($id);
        return view('orderitems.show', compact('orderitem', 'product'));
    }

    // app/Http/Controllers/OrderItemController.php
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($validated['items'] as $item) {
            $product = Product::find($item['product_id']);
            $orderitem = OrderItem::create([
                'order_id' => $validated['order_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'line_total' => $product->price * $item['quantity'],
            ]);

            $orderitem->order->recalculateAmount();
        }

        return redirect()->route('orders.show', $validated['order_id'])
            ->with('success', 'Lignes créées avec succès.');
    }
    public function edit(string $id)
    {
        $orderitem = OrderItem::findOrFail($id);
        $orders = Order::all();
        $products = Product::all();
        return view('orderitems.edit', compact('orderitem', 'orders', 'products'));
    }

    public function update(Request $request, string $id)
    {

        $orderitem = OrderItem::findOrFail($id);


        $validated = $request->validate([
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $lineTotal = $validated['unit_price'] * $validated['quantity'];
        $orderitem->update([
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'line_total' => $lineTotal,

        ]);

        $orderitem->order->recalculateAmount();

        return redirect()->route('orders.show', ['id' => $orderitem->order_id])
            ->with('success', 'La ligne de commande a bien été modifiée.');
    }
    public function destroy(string $id)
    {
        $orderitem = OrderItem::findOrFail($id);
        $order = $orderitem->order;
        $orderitem->delete();
        $order->recalculateAmount();
        return redirect()->route('orders.show', ['id' => $order->id])
            ->with('success', 'La ligne de commande a bien été supprimée.');

    }


}
