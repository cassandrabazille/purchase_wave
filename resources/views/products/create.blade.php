
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
                <h2 class="padding2">Création du produit</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="marginb2">Descriptif du produit : <input type="text" name="description" required></p>
                           <p class="password marginb2">Catégorie :
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Sélectionnez une catégorie --</option>
                        @foreach ( $categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <p class="marginb2">Prix du produit : <input type="text" name="price" required></p>
                     <p class="marginb2">Image du produit : <input type="file" name="image" id="image" accept="image/jpeg, image/png, image/jpg" required></p>
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