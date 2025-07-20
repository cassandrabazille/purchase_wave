@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <div class="container">
          @if(session('success'))
                    <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-align">
                        {{ session('success') }}
                    </div>
                @endif
                   @if ($errors->any())
    <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
        <ul class="no-list-style padding-0 margin-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <main class="padding-top-2">
            <div>
                <div class="justify-flex-end padding-2">
                    <a href="{{ url()->previous() }}">
                        <button
                            class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span>Return</span>
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
                <div class="flex-row justify-center">
                    <div class="box-responsive text-align-center border-radius-1 black-box-shadow padding-3 max-width-70pct">
                        <h2 class="margin-bottom-3">Modification du produit</h2>
                        <form action="{{ route('products.update', $product->id)}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <p class="margin-bottom-2">Descriptif du produit : <input type="text" name="description"
                                    value="{{ old('description', $product->description) }}"></p>
                            <p class="margin-bottom-2">Prix du produit : <input type="text" name="price"
                                    value="{{ old('price', $product->price) }}"></p>
                            {{-- Afficher l'image actuelle --}}
                            <p class="margin-bottom-2">
                                Image du produit :
                                <div>
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    alt="Image du produit {{ $product->reference }}" class="pdtimg"
                                    style="max-width: 200px;">
                                    </div>
                            </p>
                            {{-- Champ de remplacement d’image --}}
                            <p class="margin-bottom-2">
                                <input type="file" name="image" class="margin-top-2" accept="image/jpeg,image/png,image/jpg">
                            </p>
                            <label class="font-size-1-4">Catégorie : </label>
                            <select name="category_id"
                                class="text-align-center margin-bottom-2 black-background white-color border-radius-0-6 width-11 height-3 no-border">
                                <option value="">-- Sélectionnez une catégorie --</option>
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }} {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                           <div class="justify-center">
                            <button type="submit"
                                class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
</div>
                        </form>
                        <!-- etc. -->
                    </div>
                </div>
        </main>
@endsection
</div>



</html>