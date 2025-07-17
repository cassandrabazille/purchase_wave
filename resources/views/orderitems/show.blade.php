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