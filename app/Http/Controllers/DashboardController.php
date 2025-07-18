<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{



    public function index()
    {

        $currentUser = auth()->user();

        $upcoming = Order::with(['supplier'])
            ->where('user_id', $currentUser->user_id)
            ->where('status', 'confirmed')
            ->whereDate('confirmed_delivery_date', '>', now())
            ->orderBy('confirmed_delivery_date', 'asc')
            ->select([
                'id',
                'supplier_id',
                'reference',
                'confirmed_delivery_date',
                'order_amount'
            ])
            ->limit(7)
            ->get();


        $lateDeliveries = Order::with('supplier')
         ->where('user_id', $currentUser->user_id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->whereRaw('DATEDIFF(NOW(), COALESCE(confirmed_delivery_date, expected_delivery_date)) > 0')
            ->orderByRaw('COALESCE(confirmed_delivery_date, expected_delivery_date) ASC')
            ->select([
                'id',
                'supplier_id',
                'reference',
                'confirmed_delivery_date',
                'expected_delivery_date',
                \DB::raw('DATEDIFF(NOW(), COALESCE(confirmed_delivery_date, expected_delivery_date)) as days_late'),
                'order_amount'
            ])
            ->limit(7)
            ->get();


        $latestPendingOrders = Order::with(['supplier'])
         ->where('user_id', $currentUser->user_id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->select([
                'id',
                'supplier_id',
                'reference',
                'created_at',
                'order_amount'
            ])
            ->limit(4)
            ->get();


        $statusCounts = [
            'pending' => Order::where('user_id',$currentUser->user_id)->where('status', 'pending')->count(),
            'confirmed' => Order::where('user_id',$currentUser->user_id)->where('status', 'confirmed')->count(),
            'delivered' => Order::where('user_id',$currentUser->user_id)->where('status', 'delivered')->count(),
            'cancelled' => Order::where('user_id',$currentUser->user_id)->where('status', 'cancelled')->count(),
        ];


        $totalOrders = Order::where('user_id',$currentUser->user_id)->whereMonth('created_at', now()->month)->count();
        $totalAmount = Order::where('user_id',$currentUser->user_id)->whereMonth('created_at', now()->month)->sum('order_amount');
        $avgAmount = round(Order::where('user_id',$currentUser->user_id)->whereMonth('created_at', now()->month)->avg('order_amount') ?? 0, 2);

        $currentYear = now()->year;
        $topSuppliers = Order::with('supplier', )
           ->where('user_id', $currentUser->user_id)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('supplier_id, SUM(order_amount) as total_amount')
            ->groupBy('supplier_id')
            ->orderByDesc('total_amount')
            ->limit(3)
            ->get();




        return view('dashboard.index', compact('currentUser', 'upcoming', 'lateDeliveries', 'latestPendingOrders', 'statusCounts', 'totalOrders', 'totalAmount', 'avgAmount', 'topSuppliers', 'currentYear'));

    }





}
