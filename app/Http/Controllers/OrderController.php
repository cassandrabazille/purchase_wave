<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;

class OrderController extends Controller
{
    //Affiche la liste des commandes de l'utilisateur connecté
    public function index(Request $request)
    {
        $orders = Order::with(['user'])
            ->where('user_id', auth()->id())
            ->get();

        return view('orders.index', compact('orders'));
    }

    //Affiche le formulaire de création de commande
    public function create()
    {
        $suppliers = Supplier::select(['id', 'name'])->orderBy('name')->get();
        return view('orders.create', compact('suppliers'));

    }

    //Affiche le détail de la commande sélectionnée et ses lignes associées
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $orderitems = $order->orderItems()->with('product')->get();

        return view('orders.show', compact('order', 'orderitems'));
    }

    //Enregistre la nouvelle commande après validation du formulaire
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expected_delivery_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ], [
            'expected_delivery_date.required' => 'Une date de livraison doit obligatoirement être renseignée.',
        ]);

        $order = Order::create([
            'order_date' => now(),
            'expected_delivery_date' => $validated['expected_delivery_date'],
            'confirmed_delivery_date' => null,
            'status' => 'en attente',
            'order_amount' => 0,
            'supplier_id' => $validated['supplier_id'],
            'user_id' => auth()->id(),
        ]);

        $orderDate = Carbon::parse($order->order_date);
        $expectedDate = Carbon::parse($validated['expected_delivery_date']);

        if ($expectedDate->lt($orderDate)) {

            return back()->withErrors(['expected_delivery_date' => 'La date de livraison doit être postérieure ou égale à la date de commande'])->withInput();
        }
        return redirect()->route('orderitems.create', ['order_id' => $order->id])->with('success', 'Commande créée avec succès');
    }

    //Affiche le formulaire d'édition de commande
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette commande.');
        }

        $suppliers = Supplier::orderBy('name')->get();
        return view('orders.edit', compact('order', 'suppliers'));
    }

    // Met à jour une commande après validation du formulaire
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette commande.');
        }

        $validated = $request->validate([
            'confirmed_delivery_date' => 'nullable|date',
            'status' => 'required|in:en attente,expédiée,livrée,annulée',
        ]);

        //  Refuse le statut "expédiée" ou "livrée" sans date de livraison confirmée
        if (empty($validated['confirmed_delivery_date']) && in_array($validated['status'], ['expédiée', 'livrée'])) {
            return back()->withErrors([
                'confirmed_delivery_date' => 'Vous devez définir une date de livraison confirmée pour passer au statut "expédiée" ou "livrée".'
            ])->withInput();
        }

        // Vérifie si la date confirmée est après la date de commande
        if (!empty($validated['confirmed_delivery_date'])) {
            $orderDate = Carbon::parse($order->order_date);
            $confirmedDate = Carbon::parse($validated['confirmed_delivery_date']);

            if ($confirmedDate->lt($orderDate)) {
                return back()->withErrors([
                    'confirmed_delivery_date' => 'La date de livraison doit être postérieure ou égale à la date de commande.'
                ])->withInput();
            }
        }

        $order->update([
            'confirmed_delivery_date' => $validated['confirmed_delivery_date'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'La commande a bien été modifiée.');
    }


    // Supprime une commande sélectionnée et renvoie à l'index une fois la suppression effectuée
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer cette commande.');
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'La commande a bien été supprimée.');

    }
}

