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
                <h2 class="padding2">Création de la ligne de commande</h2>
                <form action="{{ route('orderitems.store') }}" method="POST">
                    @csrf
                      <select name="order_id" class="form-select">
                        <option value="">-- Sélectionnez une commande --</option>
                        @foreach ( $orders as $order)
                        <option value="{{ $order->id }}">{{ $order->reference }}</option>
                        @endforeach
                          </select>
                          <br>
                            <select name="product_id" class="form-select">
                        <option value="">-- Sélectionnez un produit --</option>
                        @foreach ( $products as $product)
                        <option value="{{ $product->id }}">{{ $product->reference }}</option>
                        @endforeach
                    </select>
                    <p class="marginb2">Quantité de produits<input type="text" name="quantity"></p>
                    <p class="marginb2">Prix unitaire du produit : <input type="text" name="unit_price"></p>
                    <p class="marginb2">Montant total de la ligne: <input type="text" name="line_total"></p>
                    </p>
                    <button type="submit">Confirmer</button>
                </form>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection

</html>