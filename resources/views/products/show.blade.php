@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                 <a href="{{ url()->previous() }}">
                        <button class="returnbtn text-align-right width-4 height-4 flex items-center">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Détail du produit</h2>
                <p>Référence du produit : <strong>{{ $product->reference }}</strong></p>
                <p>Descriptif du produit : <strong>{{ $product->description }}</strong></p>
                 <p>Catégorie du produit : <strong>{{ $product->category ? $product->category->name : 'Aucune catégorie'}}</strong></p>
                 <p>Utilisateur qui a créé le produit : <strong>{{ $product->user ? $product->user->name : 'Utilisateur inconnu' }}</strong> </p>
                <p>Prix du produit : <strong>{{ $product->price }} €</strong></p>
                <img src="{{ asset('storage/' .$product->image) }}" alt="Image du produit {{ $product->reference }}" class="pdtimg">

            </div>
        </div>
    </main>
@endsection
</div>
</html>