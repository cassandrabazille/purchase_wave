@extends('layouts.user')

@section('title', 'Création de commande')

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
                <h2 class="padding2">Création des lignes de commande</h2>

                <form action="{{ route('orderitems.store') }}" method="POST" id="order-items-form">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    
        <div class="order-item marginb2">
            <div class="form-group">
                <label>Produit</label>
                <select name ="items[0][product_id]" class="product-select" required>
                    <option value="">-- Sélectionnez un produit --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->reference }} {{ number_format($product->price, 2, ',', ' ') }} 
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Quantité</label>
                <input type="number" name="items[0][quantity]" class="quantity" min="1" value="1" required>
            </div>
        </div>
    

    <div class="form-actions">
        <button type="submit">Enregistrer</button>
    </div>
</form>

            </div>
        </div>
    </main>
    </div>
@endsection

