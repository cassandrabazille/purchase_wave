<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Supplier;
use Carbon\Carbon;

class OrderController extends Controller
{
    // Affiche la liste des commandes de l'utilisateur actuellement connecté
    public function index()
    {

        $orders = Order::with(['user'])
            ->where('user_id', auth()->id())
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Affiche le formulaire de création d'une nouvelle commande
    public function create()
    {
        $suppliers = Supplier::select(['id', 'name']) // Sélectionne uniquement les colonnes 'id' et 'name'
            ->orderBy('name') // Trie les fournisseurs par nom
            ->get(); // Exécute la requête

        return view('orders.create', compact('suppliers')); // Transmet les fournisseurs à la vue de création
    }

    // Affiche les détails d'une commande donnée
    public function show($id)
    {
        $order = Order::findOrFail($id); // Récupère la commande ou renvoie une 404 si non trouvée

        $orderitems = $order->orderItems() // Récupère la relation orderItems (lignes de commande)
            ->with('product') // Précharge les produits associés aux lignes de commande
            ->get(); // Exécute la requête

        return view('orders.show', compact('order', 'orderitems')); // Envoie les données à la vue de détail
    }

    // Enregistre une nouvelle commande à partir du formulaire
    public function store(Request $request)
    {
        $validated = $request->validate([ // Valide les données entrées par l'utilisateur
            'expected_delivery_date' => 'required|date', // Champ obligatoire et de type date
            'supplier_id' => 'required|exists:suppliers,id', // Doit correspondre à un ID de fournisseur existant
        ], [
            'expected_delivery_date.required' => 'Une date de livraison doit obligatoirement être renseignée.',
            'supplier_id.required' => 'Un fournisseur doit obligatoirement être sélectionné.',
        ]);

        $order = Order::create([ // Crée un nouvel enregistrement de commande avec les valeurs ci-dessous
            'order_date' => now(), // Date de commande = date actuelle
            'expected_delivery_date' => $validated['expected_delivery_date'],
            'confirmed_delivery_date' => null, // Initialement non confirmée
            'status' => 'en attente', // Statut initial
            'order_amount' => 0, // Valeur initiale à 0, sera mise à jour plus tard
            'supplier_id' => $validated['supplier_id'], // Fournisseur choisi
            'user_id' => auth()->id(), // ID de l'utilisateur connecté
        ]);

        $orderDate = Carbon::parse($order->order_date); // Convertit la date de commande en objet Carbon
        $expectedDate = Carbon::parse($validated['expected_delivery_date']); // Convertit la date attendue aussi

        if ($expectedDate->lt($orderDate)) { // Si la date attendue est antérieure à la commande => erreur
            return back()->withErrors([
                'expected_delivery_date' => 'La date de livraison doit être postérieure ou égale à la date de commande'
            ])->withInput();
        }

        return redirect()->route('orderitems.create', ['order_id' => $order->id]) // Redirige vers ajout de lignes
            ->with('success', 'Commande créée avec succès');
    }

    // Affiche le formulaire d'édition d'une commande existante
    public function edit(string $id)
    {
        $order = Order::findOrFail($id); // Récupère la commande, ou erreur 404

        if ($order->user_id !== auth()->id()) { // Sécurité : empêche d'éditer une commande d'un autre utilisateur
            abort(403, 'Vous n\'etes pas autorisé à modifier cette commande.');
        }

        $suppliers = Supplier::orderBy('name')->get(); // Liste des fournisseurs triés pour la liste déroulante

        return view('orders.edit', compact('order', 'suppliers')); // Transmet les données à la vue d'édition
    }

    // Met à jour les informations d'une commande
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id); // Recherche la commande

        if ($order->user_id !== auth()->id()) { // Empêche la modification par un autre utilisateur
            abort(403, 'Vous n\'etes pas autorisé à modifier cette commande.');
        }

        $validated = $request->validate([ // Valide les données modifiées
            'confirmed_delivery_date' => 'nullable|date',
            'status' => 'required|in:en attente,expédiée,livrée,annulée',
        ]);

        // Si le statut implique une livraison, la date confirmée doit être présente
        if (empty($validated['confirmed_delivery_date']) && in_array($validated['status'], ['expédiée', 'livrée'])) {
            return back()->withErrors([
                'confirmed_delivery_date' => 'Vous devez définir une date de livraison confirmée pour passer au statut "expédiée" ou "livrée".'
            ])->withInput();
        }

        if (!empty($validated['confirmed_delivery_date'])) { // Si date fournie, vérifie qu'elle est cohérente
            $orderDate = Carbon::parse($order->order_date);
            $confirmedDate = Carbon::parse($validated['confirmed_delivery_date']);

            if ($confirmedDate->lt($orderDate)) {
                return back()->withErrors([
                    'confirmed_delivery_date' => 'La date de livraison doit être postérieure ou égale à la date de commande.'
                ])->withInput();
            }
        }

        $order->update([ // Met à jour les champs modifiables de la commande
            'confirmed_delivery_date' => $validated['confirmed_delivery_date'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'La commande a bien été modifiée.');
    }

    // Supprime une commande existante
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id); // Recherche la commande

        if ($order->user_id !== auth()->id()) { // Empêche la suppression par un utilisateur non autorisé
            abort(403, 'Vous n\'etes pas autorisé à supprimer cette commande.');
        }

        $order->delete(); // Supprime l'enregistrement

        return redirect()->route('orders.index') // Retourne à la liste des commandes
            ->with('success', 'La commande a bien été supprimée.');
    }
}


