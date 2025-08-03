@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

    <div class="container">
        <div class="padding-top-2">
            <div>

                <div class="justify-flex-end padding-2">
                    <a href="{{ url()->previous() }}"
                        class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 flex items-center">
                        <img src="{{ asset('images/return.png') }}"
                            alt="Flèche qui indique la possibilité de retourner sur la page précédente."
                            class="object-fit-contain padding-left-2 width-4 height-4">
                        <span>Return</span>
                    </a>
                </div>

                <div class="justify-center">
                    <div class="max-width-70pct border-radius-1 black-box-shadow padding-3">
                        <h2 class="margin-bottom-3">Détail du produit</h2>
                        <p class="margin-bottom-1">Référence du produit : <strong>{{ $product->reference }}</strong></p>
                        <p class="margin-bottom-1">Descriptif du produit : <strong>{{ $product->description }}</strong></p>
                        <p class="margin-bottom-1">Catégorie du produit :
                            <strong>{{ $product->category ? $product->category->name : 'Aucune catégorie'}}</strong></p>
                        <p class="margin-bottom-1">Utilisateur qui a créé le produit :
                            <strong>{{ $product->user ? $product->user->name : 'Utilisateur inconnu' }}</strong> </p>
                        <p class="margin-bottom-1">Prix du produit : <strong>{{ $product->price }} €</strong></p>
                        <p class="margin-bottom-3">Fournisseur du produit : <strong>{{ $product->supplier->name }}</strong></p>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit {{ $product->reference }}"
                            class="object-fit-contain max-width-100pct max-height-40">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection