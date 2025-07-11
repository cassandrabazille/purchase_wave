@extends('layouts.user')

@section('title', 'Création de commande')

@section('content')
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                <a href="{{ route('orders.index') }}">
                    <button class="returnbtn textalignr">
                        <img src="{{ asset('images/return.png') }}" alt="Retour" />Return
                    </button>
                </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Création des lignes de commande</h2>

                <form action="{{ route('orderitems.store') }}" method="POST" id="order-items-form">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">

    @for ($i = 0; $i < 3; $i++)
        <div class="order-item marginb2" data-index="{{ $i }}">
            <div class="form-group">
                <label>Produit</label>
                <select name="items[{{ $i }}][product_id]" class="product-select" required>
                    <option value="">-- Sélectionnez --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->reference }} ({{ number_format($product->price, 2, ',', ' ') }} €)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Quantité</label>
                <input type="number" name="items[{{ $i }}][quantity]" class="quantity" min="1" value="1" required>
            </div>
        </div>
    @endfor

    <div class="form-actions">
        <button type="submit">Enregistrer</button>
    </div>
</form>

            </div>
        </div>
    </main>
@endsection

