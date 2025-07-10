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
        
        return view('orderitems.create', compact('orderitem', 'suppliers'));

    }
}
