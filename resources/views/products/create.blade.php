
@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="padding-top-2">
        <div>
            <div class="justify-flex-end padding-2">
                <a href="{{ url()->previous() }}">
                         <button class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span>Return</span>
                        </button>
                    </a>
            </div>
               <div class="flex-row justify-center">
            <div class="border-radius-1 black-box-shadow padding-3 max-width-70pct">
                <h2 class="margin-bottom-2">Création du produit</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="margin-bottom-2">Descriptif du produit : <input type="text" name="description" required></p>
                           <p class="margin-bottom-2">Catégorie :
                    <select name="category_id" class="text-align-center black-background white-color border-radius-0-6 width-11 height-3 no-border" required>
                        <option value="">-- Sélectionnez une catégorie --</option>
                        @foreach ( $categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <p class="margin-bottom-2">Prix du produit : <input type="text" name="price" required></p>
                     <p class="margin-bottom-2">Image du produit : <input type="file" name="image" id="image" accept="image/jpeg, image/png, image/jpg" required></p>
                </p>
                    <button type="submit" class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                </form>
</div>
            </div>
        </div>
    </main>
@endsection
</div>
</html>