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
                    <br>
                    <select name="supplier_id" class="form-select marginb2">
                        <option value="">-- Sélectionnez un fournisseur --</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id', $order->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    <p>Nouvelle date de livraison : <input type="date" name="expected_delivery_date"
                            min="{{ $order->order_date->format('d-m-Y') }}"
                            value="{{ old('expected_delivery_date', $order->expected_delivery_date ? $order->expected_delivery_date->format('Y-m-d') : '') }}"
                            class="form-control"></p>

                    <br>
                    <p> Montant HT(€)
                        <input type="number" name="order_amount" step="0.01"
                            value="{{ old('order_amount', $order->order_amount) }}">
                    </p>
                    <button type="submit">Confirmer</button>

                </form>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection

</html>