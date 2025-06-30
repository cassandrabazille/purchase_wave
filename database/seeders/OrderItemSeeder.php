<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $orders = Order::all();
    $products = Product::all();

    if ($orders->isEmpty() || $products->isEmpty()) {
        $this->command->warn('Orders or Products table is empty. Please seed them first.');
        return;
    }

    for ($i = 0; $i < 15; $i++) {
        $order = $orders->random();
        $product = $products->random();
        $quantity = rand(1, 10);
        $unitPrice = $product->price;

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'line_total' => $quantity * $unitPrice,
        ]);
    }

    // Mise à jour des montants totaux des commandes
    foreach ($orders as $order) {
        $total = $order->orderItems()->sum('line_total');
        $order->update(['order_amount' => $total]);
    }
}
}
