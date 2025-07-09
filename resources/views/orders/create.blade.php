@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                <a href={{route('orders.index')}}>
                    <button class="returnbtn textalignr"><img src="{{ asset('images/return.png') }}"
                            alt="Flèches de retour vers la page précédente" />Return</button>
                </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Création de la commande</h2>

                <form action="POST" {{ route('orders.store') }}>
                    <p class="marginb2">Date de commande : {{ old('order_date', now()->format('d-m-Y')) }}</p>
                    <p>Fournisseur :
                        <select name="supplier_id" class="marginb2">
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </p>
                    <p class="marginb2">Montant HT (€) : <input type="text"></p>
                    <p>Date de livraison : <input type="date" name="delivery_date" min="{{ now()->format('d-m-Y') }}"
                            class="form-control"></p>

                    <button type="submit">Confirmer</button>

                </form>

                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection

</html>