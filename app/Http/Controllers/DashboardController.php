<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{

    public function index()
    {

        $currentUser = auth()->user();

        $latestPendingOrders = Order::with(['supplier'])
            ->where('user_id', $currentUser->user_id)
            ->where('status', 'en attente')
            ->orderBy('created_at', 'desc')
            ->select([
                'id',
                'supplier_id',
                'reference',
                'created_at',
                'order_amount'
            ])
            ->limit(4)
            ->get()
            ->filter(fn($order) => $order && $order->id);


        $lateDeliveries = Order::with('supplier')
            ->where('user_id', $currentUser->user_id)
            ->where('status', 'en attente')
            ->whereNull('confirmed_delivery_date')
            ->whereRaw('DATEDIFF(NOW(), expected_delivery_date) > 0')
            ->orderByDesc(\DB::raw('DATEDIFF(NOW(), expected_delivery_date)')) // tri par jours de retard décroissant
            ->select([
                'id',
                'supplier_id',
                'reference',
                'confirmed_delivery_date',
                'expected_delivery_date',
                \DB::raw('DATEDIFF(NOW(), expected_delivery_date) as days_late'),
                'order_amount'
            ])
            ->limit(7)
            ->get();



        $upcoming = Order::with(['supplier'])
            ->where('user_id', $currentUser->user_id)
            ->where('status', 'expédiée')
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
            ->get()
            ->filter(fn($order) => $order && $order->id);



        $statusCounts = [
            'en attente' => Order::where('user_id', $currentUser->user_id)->where('status', 'en attente')->count(),
            'expédiée' => Order::where('user_id', $currentUser->user_id)->where('status', 'expédiée')->count(),
            'livrée' => Order::where('user_id', $currentUser->user_id)->where('status', 'livrée')->count(),
            'annulée' => Order::where('user_id', $currentUser->user_id)->where('status', 'annulée')->count(),
        ];


        $totalOrders = Order::where('user_id', $currentUser->user_id)
            ->whereMonth('created_at', now()->month)
            ->where('status', '!=', 'annulée')
            ->count();

        $totalAmount = Order::where('user_id', $currentUser->user_id)
            ->whereMonth('created_at', now()->month)
            ->where('status', '!=', 'annulée')
            ->sum('order_amount');

        $avgAmount = round(
            Order::where('user_id', $currentUser->user_id)
                ->whereMonth('created_at', now()->month)
                ->where('status', '!=', 'annulée')
                ->avg('order_amount') ?? 0,
            2
        );


        $currentYear = now()->year;
        $topSuppliers = Order::with('supplier')
            ->where('user_id', $currentUser->user_id)
            ->whereYear('created_at', $currentYear)
            ->where('status', '!=', 'annulée') // 👈 Exclure les commandes annulées
            ->selectRaw('supplier_id, SUM(order_amount) as total_amount')
            ->groupBy('supplier_id')
            ->orderByDesc('total_amount')
            ->limit(3)
            ->get();





        return view('dashboard.index', compact('currentUser', 'upcoming', 'lateDeliveries', 'latestPendingOrders', 'statusCounts', 'totalOrders', 'totalAmount', 'avgAmount', 'topSuppliers', 'currentYear'));

    }





}
