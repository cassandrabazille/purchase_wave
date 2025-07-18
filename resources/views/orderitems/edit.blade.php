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
            <div class="border-radius-1 black-box-shadow padding-3">
                <h2 class="margin-bottom-2">Modification de la ligne de commande</h2>
                <form action="{{ route('orderitems.update', $orderitem->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                           
                    <p class="margin-bottom-2">Quantité de produits : <input type="text" name="quantity"
                            value="{{ old('description', $orderitem->quantity) }}"></p>
                    <p class="margin-bottom-2">Prix unitaire du produit : <input type="text" name="unit_price"
                            value="{{ old('price', $orderitem->unit_price) }}"></p>
                    <br>
                    <button type="submit" class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                </form>
                </div>
            </div>
        </div>
    </main>
@endsection
</div>
</html>