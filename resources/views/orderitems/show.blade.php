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
                <h2 class="padding2">Détail de la ligne de commande</h2>
                <p>Commande rattachée à la ligne: {{ $orderitem->order->reference }}</p>
                <p>Produit rattaché à la ligne {{ $orderitem->product->reference }}</p>
                <p>Quantité de produits : {{ $orderitem->quantity }}</p>
                <p>Prix unitaire du produit : {{ $orderitem->unit_price }}</p>
                <p>Montant total de la ligne: {{ $orderitem->line_total}}</p>
                
            </div>
        </div>
    </main>
@endsection

</html>