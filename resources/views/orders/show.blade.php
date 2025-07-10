@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                <a href="{{  url()->previous() }}">
                    <button class="returnbtn textalignr"><img src="{{ asset('images/return.png') }}"
                            alt="Flèches de retour vers la page précédente" />Return</button>
                </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Détail de la commande</h2>
                <p>Référence: {{ $order->reference }}</p>
                <p>Date de la commande : {{ date('d/m/Y', strtotime($order->order_date)) }}</p>
                <p>Acheteur*se : {{ $order->user->name }}</p>
                <p>Statut : {{ $order->status }}</p>
                <p>Fournisseur : {{ $order->supplier->name}}</p>
                <p>Montant HT (€) : {{number_format($order->order_amount, 2, ',', ' ')}}</p>
                <p>Livraison initiale : {{ $order->expected_delivery_date ? date('d/m/Y', strtotime($order->expected_delivery_date)) : 'N/A' }}</p>
                <p>Livraison confirmée: {{ $order->confirmed_delivery_date ? date('d/m/Y', strtotime($order->confirmed_delivery_date)) : 'N/A' }}</p>
                
            </div>
        </div>
    </main>
@endsection

</html>