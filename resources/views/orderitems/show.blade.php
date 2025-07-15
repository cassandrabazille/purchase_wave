@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
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
                <p>Référence du produit : {{ $product->reference }}</p>
                <p>Descriptif du produit : {{ $product->description }}</p>
                <p>Prix du produit : {{ $product->price }}</p>
                <p>Image du produit : {{ $product->image }}</p>
                <p>Catégorie du produit : {{ $product->category ? $product->category->name : 'Aucune catégorie'}}</p>
                
            </div>
        </div>
    </main>
@endsection
</div>
</html>