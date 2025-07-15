@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
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

                <form action=" {{ route('orders.store') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>Fournisseur :
                        <select name="supplier_id" class="marginb2" required>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>Date de livraison : <input type="date" name="expected_delivery_date"
                            min="{{ now()->format('d-m-Y') }}" class="form-control"></p>
                    <button type="submit">Confirmer</button>

                </form>

                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection
</div>
</html>