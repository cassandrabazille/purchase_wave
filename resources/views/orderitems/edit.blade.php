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
                <h2 class="padding2">Modification de la ligne de commande</h2>
                <form action="{{ route('orderitems.update', $orderitem->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                             <select name="order_id" class="form-select marginb2">
                        <option value="">-- Sélectionnez une commande --</option>
                        @foreach ($orders as $order)
                            <option value={{ $order->id }} {{ old('order_id', $orderitem->order_id) == $order->id ? 'selected' : '' }}>
                                {{ $order->reference }}
                            </option>
                        @endforeach
                            </select>
                            <br>
                         <select name="product_id" class="form-select marginb2">
                         <option value="">-- Sélectionnez un produit--</option>
                        @foreach ($products as $product)
                            <option value={{ $product->id }} {{ old('product_id', $orderitem->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->reference }}
                            </option>
                        @endforeach
                    </select>
                    <p class="marginb2">Quantité de produits : <input type="text" name="quantity"
                            value="{{ old('description', $orderitem->quantity) }}"></p>
                    <p class="marginb2">Prix unitaire du produit : <input type="text" name="unit_price"
                            value="{{ old('price', $orderitem->unit_price) }}"></p>
                    <p class="marginb2">Montant total de la ligne de commande : <input type="text" name="line_total"
                            value="{{ old('image', $orderitem->line_total) }}"></p>
           
                    <br>
                    <button type="submit">Confirmer</button>
                </form>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection

</html>