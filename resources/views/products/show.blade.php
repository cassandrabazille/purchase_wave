@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                 <a href="{{ url()->previous() }}">
                       <button class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
            </div>
            <div class="border-radius-1 black-box-shadow padding-3">
                <h2 class="padding2 margin-bottom-1">Détail du produit</h2>
                <p class="margin-bottom-1">Référence du produit : <strong>{{ $product->reference }}</strong></p>
                <p class="margin-bottom-1">Descriptif du produit : <strong>{{ $product->description }}</strong></p>
                 <p class="margin-bottom-1">Catégorie du produit : <strong>{{ $product->category ? $product->category->name : 'Aucune catégorie'}}</strong></p>
                 <p class="margin-bottom-1">Utilisateur qui a créé le produit : <strong>{{ $product->user ? $product->user->name : 'Utilisateur inconnu' }}</strong> </p>
                <p class="margin-bottom-1">Prix du produit : <strong>{{ $product->price }} €</strong></p>
                <img src="{{ asset('storage/' .$product->image) }}" alt="Image du produit {{ $product->reference }}" class="object-fit-contain max-width-100pct max-height-40">

            </div>
        </div>
    </main>
@endsection
</div>
</html>