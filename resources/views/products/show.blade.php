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
                <h2 class="padding2">Détail du produit</h2>
                <p>Référence du produit : <strong>{{ $product->reference }}</strong></p>
                <p>Descriptif du produit : <strong>{{ $product->description }}</strong></p>
                 <p>Catégorie du produit : <strong>{{ $product->category ? $product->category->name : 'Aucune catégorie'}}</strong></p>
                <p>Prix du produit : <strong>{{ $product->price }} €</strong></p>
                <img src="{{ asset('images/' .$product->image) }}" alt="Image du produit {{ $product->reference }}" class="pdtimg">

            </div>
        </div>
    </main>
@endsection

</html>