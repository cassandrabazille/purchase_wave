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
                <h2 class="padding-bottom-2">Modification du fournisseur</h2>
                <form action="{{ route('suppliers.update', $supplier->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <p class="margin-bottom-2">Nouveau nom du fournisseur : <input type="text" name="name"
                            value="{{ old('name', $supplier->name) }}"></p>
                    <p class="margin-bottom-2">Nouvelle adresse mail du fournisseur : <input type="text" name="email"
                            value="{{ old('email', $supplier->email) }}"></p>
                    <p class="margin-bottom-2">Nouveau numéro de téléphone : <input type="text" name="telephone"
                            value="{{ old('telephone', $supplier->telephone) }}"></p>
                    <p class="margin-bottom-2">Nouveau numéro de téléphone : <input type="text" name="address"
                            value="{{ old('address', $supplier->address) }}"></p>
                    <br>
                    <button type="submit" class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>

                </form>
               </div>
            </div>
        </div>
    </main>
@endsection
</div>
</html>