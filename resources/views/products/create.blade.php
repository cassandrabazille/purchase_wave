
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
                <h2 class="padding2">Création du produit</h2>
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <p class="marginb2">Descriptif du produit : <input type="text" name="description"></p>
                           <p class="password marginb2">Catégorie :
                    <select name="category_id" class="form-select">
                        <option value="">-- Sélectionnez une catégorie --</option>
                        @foreach ( $categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <p class="marginb2">Prix du produit : <input type="text" name="price"></p>
                     <p class="marginb2">Image du produit : <input type="text" name="image"></p>
                </p>
                    <button type="submit">Confirmer</button>
                </form>

                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection
</div>
</html>