@extends('layouts.user')

@section('title', 'Création de commande')

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
            <div class="border-radius-1 black-box-shadow padding-3 width-51-1">
                <h2 class="margin-bottom-2">Création d'une ligne de commande</h2>

                <form action="{{ route('orderitems.store') }}" method="POST" id="order-items-form">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    
        <div class="order-item marginb2">
            <div class="form-group">
                <label class="font-size-1-4">Produit : </label>
                <select name ="items[0][product_id]" class="text-align-center margin-bottom-2 black-background white-color border-radius-0-6 width-11 height-3 no-border" required>
                    <option value="">-- Sélectionnez un produit --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->reference }} {{ number_format($product->price, 2, ',', ' ') }} 
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="margin-bottom-2">
                <label class="font-size-1-4">Quantité :</label>
                <input type="number" name="items[0][quantity]" min="1" value="1" required>
            </div>
        </div>
    

    <div class="form-actions">
        <button type="submit" class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Enregistrer</button>
    </div>
</form>
</div>
            </div>
        </div>
    </main>
    </div>
@endsection

