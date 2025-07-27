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

                    <div class="box-responsive text-align-center border-radius-1 black-box-shadow padding-3">

                        <h2 class="margin-bottom-2">Modification de la ligne de commande</h2>

                        <form action="{{ route('orderitems.update', $orderitem->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <label for="quantity" class="margin-bottom-2">Quantité de produits :
                                <input type="text" id="quantity" name="quantity"
                                    value="{{ old('description', $orderitem->quantity) }}"></label>

                            <label for="unit_price" class="margin-bottom-2">Prix unitaire du produit :
                                <input type="text" id="unit_price" name="unit_price"
                                    value="{{ old('price', $orderitem->unit_price) }}"></label>

                            <div class="justify-center">
                                <button type="submit"
                                    class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
@endsection