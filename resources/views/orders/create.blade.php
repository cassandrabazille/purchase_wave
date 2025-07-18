@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="padding-top-2">
        <div>
            <div class="justify-flex-end padding-2">
                  <a href="{{ url()->previous() }}">
                        <button class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span>Return</span>
                        </button>
                    </a>
            </div>
            <div class="flex-row justify-center">
            <div class="border-radius-1 black-box-shadow padding-3 max-width-27-5">
                <h2 class="padding-bottom-2">Création de la commande</h2>

                <form action=" {{ route('orders.store') }}" method="POST">
                    @csrf
                    <p class="margin-bottom-2">Fournisseur :
                                        <select name ="supplier_id" class="text-align-center margin-bottom-2 black-background white-color border-radius-0-6 width-11 height-3 no-border" required>
                    <option value="">-- Sélectionnez un fournisseur --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </p>
                    <p class="padding-bottom-2">Date de livraison : <input type="date" name="expected_delivery_date"
                            min="{{ now()->format('d-m-Y') }}" class="form-control"></p>
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
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection
</div>
</html>