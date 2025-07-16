@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
             <a href="{{ url()->previous() }}">
                        <button class="returnbtn text-align-right width-4 height-4 flex items-center">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Modification du fournisseur</h2>
                <form action="{{ route('suppliers.update', $supplier->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <p class="marginb2">Nouveau nom du fournisseur : <input type="text" name="name"
                            value="{{ old('name', $supplier->name) }}"></p>
                    <p class="marginb2">Nouvelle adresse mail du fournisseur : <input type="text" name="email"
                            value="{{ old('email', $supplier->email) }}"></p>
                    <p class="marginb2">Nouveau numéro de téléphone : <input type="text" name="telephone"
                            value="{{ old('telephone', $supplier->telephone) }}"></p>
                    <p class="marginb2">Nouveau numéro de téléphone : <input type="text" name="address"
                            value="{{ old('address', $supplier->address) }}"></p>
                    <br>
                    <button type="submit">Confirmer</button>

                </form>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection
</div>
</html>