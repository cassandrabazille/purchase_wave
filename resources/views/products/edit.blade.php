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
                <h2 class="padding2">Modification du produit</h2>
                <form action="{{ route('products.update', $product->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <p class="marginb2">Nouveau descriptif du produit : <input type="text" name="description"
                            value="{{ old('description', $product->description) }}"></p>
                    <p class="marginb2">Nouveau prix du produit : <input type="text" name="price"
                            value="{{ old('price', $product->price) }}"></p>
                    <p class="marginb2">Nouvelle image du produit : <input type="text" name="image"
                            value="{{ old('image', $product->image) }}"></p>
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

</html>