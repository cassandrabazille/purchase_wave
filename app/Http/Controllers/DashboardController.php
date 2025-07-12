<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{

    public function index()
    { 

        $upcoming = Order::with(['supplier'])
        ->where('status', 'confirmed')
        ->whereDate('confirmed_delivery_date', '>' , now())
        ->orderBy('confirmed_delivery_date', 'asc')
        ->select([
            'id',
            'supplier_id',
            'reference',
            'confirmed_delivery_date',
            'order_amount'
        ])
        ->limit(5)
        ->get();


         $lateDeliveries = Order::with(['supplier'])
        ->where('status', 'confirmed')
        ->whereDate('confirmed_delivery_date', '<' , now())
        ->orderBy('confirmed_delivery_date', 'asc')
        ->select([
            'id',
            'supplier_id',
            'reference',
            'confirmed_delivery_date',
            \DB::raw('DATEDIFF(NOW(), confirmed_delivery_date) as days_late'),
            'order_amount'
        ])
        ->limit(5)
        ->get();

        
         $latestPendingOrders = Order::with(['supplier'])
        ->where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->select([
            'id',
            'supplier_id',
            'reference',
            'created_at',
            'order_amount'
        ])
        ->limit(2)
        ->get();


            $statusCounts = [
                'pending' => Order::where('status', 'pending')->count(),
                'confirmed' => Order::where('status', 'confirmed')->count(),
                'delivered' => Order::where('status', 'delivered')->count(),
                'cancelled' => Order::where('status', 'cancelled')->count(),
            ];

            $orders = Order::all();

            $totalOrders = Order::whereMonth('created_at', now()->month)->count();
            $totalAmount = Order::whereMonth('created_at', now()->month)->sum('order_amount');
            $avgAmount = round(Order::whereMonth('created_at', now()->month)->avg('order_amount') ?? 0, 2);

            $currentYear = now()->year;
            $topSuppliers = Order::with('supplier', )
                ->whereYear('created_at', $currentYear)
                ->selectRaw('supplier_id, SUM(order_amount) as total_amount')
                ->groupBy('supplier_id')
                ->orderByDesc('total_amount')
                ->limit(3)
                ->get();



        
        return view('dashboard.index', compact('upcoming', 'lateDeliveries', 'latestPendingOrders','statusCounts', 'totalOrders', 'totalAmount', 'avgAmount', 'topSuppliers','currentYear'));

    }





}
