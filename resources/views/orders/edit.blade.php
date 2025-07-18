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
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
            </div>
            <div class="flex-row justify-center">
            <div class="border-radius-1 black-box-shadow padding-3">
                <h2 class="padding-bottom-2">Modification de la commande</h2>
                <form action="{{ route('orders.update', $order->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="font-size-1-4">Statut : </label>
                    <select name="status" class="text-align-center margin-bottom-2 black-background white-color border-radius-0-6 width-11 height-3 no-border">
                        <option value="">-- Sélectionnez un statut --</option>
                        <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>En attente
                        </option>
                        <option value="confirmed" {{ old('status', $order->status) === 'confirmed' ? 'selected' : '' }}>
                            Confirmée</option>
                        <option value="shipped" {{ old('status', $order->status) === 'shipped' ? 'selected' : '' }}>Expédiée
                        </option>
                        <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>
                            Annulée
                        </option>
                    </select>
                    <p class="margin-bottom-2">Nouvelle date de livraison : <input type="date" name="confirmed_delivery_date"
                            min="{{ $order->order_date->format('d-m-Y') }}"
                            value="{{ old('confirmed_delivery_date', $order->confirmed_delivery_date ? $order->confirmed_delivery_date->format('Y-m-d') : '') }}"
                            class="form-control"></p>
                                       @if ($errors->any())
                        <div>
                            <ul class="red-color no-list-style margin-bottom-2 font-weight-500 font-size-1-2 italic">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>

                </form>
               </div>
            </div>
        </div>
    </main>
@endsection
</div>
</html>