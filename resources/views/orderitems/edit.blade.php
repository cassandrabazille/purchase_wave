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
                <h2 class="padding2">Modification de la ligne de commande</h2>
                <form action="{{ route('orderitems.update', $orderitem->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                           
                    <p class="marginb2">Quantité de produits : <input type="text" name="quantity"
                            value="{{ old('description', $orderitem->quantity) }}"></p>
                    <p class="marginb2">Prix unitaire du produit : <input type="text" name="unit_price"
                            value="{{ old('price', $orderitem->unit_price) }}"></p>
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