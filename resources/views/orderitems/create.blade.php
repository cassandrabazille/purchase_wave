@extends('layouts.user')

@section('title', 'Création de commande')

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

        <div class="padding-top-2">
            <div>
                <div class="justify-flex-end padding-2">
                    <a href="{{ url()->previous() }}"
                        class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 flex items-center">
                        <img src="{{ asset('images/return.png') }}"
                            alt="Flèche qui indique la possibilité de retourner sur la page précédente."
                            class="object-fit-contain padding-left-2 width-4 height-4">
                        <span>Return</span>
                    </a>
                </div>
                <div class="flex-row justify-center">
                    <div class="box-responsive text-align-center border-radius-1 black-box-shadow padding-3 width-51-1">
                        <h2 class="margin-bottom-2">Création d'une ligne de commande</h2>

                        <form action="{{ route('orderitems.store') }}" method="POST" id="order-items-form">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">

                            <div class="order-item marginb2">
                                <div class="form-group">
                                    <label class="font-size-1-4">Produit : </label>
                                    <select name="items[0][product_id]"
                                        class="text-align-center margin-bottom-2 black-background white-color border-radius-0-6 width-11 height-3 no-border"
                                        required>
                                        <option value="">-- Sélectionnez un produit --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->reference }} {{ $product->slug }}
                                                {{ number_format($product->price, 2, ',', ' ') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="margin-bottom-2">
                                    <label for="number" class="font-size-1-4">Quantité :</label>
                                    <input type="number" id="number" name="items[0][quantity]" min="1" value="1" required>
                                </div>

                            </div>

                            <div class="justify-center">
                                <button type="submit"
                                    class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Enregistrer</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection