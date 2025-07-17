@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
               <a href="{{ url()->previous() }}">
                        <button class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
            </div>
            <div class="border-radius-1 black-box-shadow padding-3">
                <h2 class="padding2">Modification de la commande</h2>
                <form action="{{ route('orders.update', $order->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select marginb2">
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
                    <p>Nouvelle date de livraison : <input type="date" name="confirmed_delivery_date"
                            min="{{ $order->order_date->format('d-m-Y') }}"
                            value="{{ old('confirmed_delivery_date', $order->confirmed_delivery_date ? $order->confirmed_delivery_date->format('Y-m-d') : '') }}"
                            class="form-control"></p>

                    <button type="submit">Confirmer</button>

                </form>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection
</div>
</html>