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
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                <div class="whitebox">
                    <h2 class="padding2">Modification du produit</h2>
                    <form action="{{ route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p class="marginb2">Nouveau descriptif du produit : <input type="text" name="description"
                                value="{{ old('description', $product->description) }}"></p>
                        <p class="marginb2">Nouveau prix du produit : <input type="text" name="price"
                                value="{{ old('price', $product->price) }}"></p>
                        {{-- Afficher l'image actuelle --}}
                        <p class="marginb2">
                            Image actuelle :<br>
                            <img src="{{ asset('storage/' . $product->image) }}"
                                alt="Image du produit {{ $product->reference }}" class="pdtimg" style="max-width: 200px;">
                        </p>
                        {{-- Champ de remplacement d’image --}}
                        <p class="marginb2">
                            Nouvelle image du produit :<br>
                            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg">
                        </p>

                        <select name="category_id" class="form-select marginb2">
                            <option value="">-- Sélectionnez une catégorie --</option>
                            @foreach ($categories as $category)
                                <option value={{ $category->id }} {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit">Confirmer</button>

                    </form>
                    <!-- etc. -->
                </div>
            </div>
        </main>
@endsection
</div>



</html>