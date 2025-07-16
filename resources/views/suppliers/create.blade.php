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
                <h2 class="padding2">Création du fournisseur</h2>
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <p class="marginb2">Nom du fournisseur <input type="text" name="name"></p>
                    <p class="marginb2">Téléphone du fournisseur <input type="text" name="telephone"></p>
                    <p class="marginb2">Mail du fournisseur : <input type="text" name="email"></p>
                    <p class="marginb2">Adresse du fournisseur : <input type="text" name="address"></p>
                    </p>
                    <button type="submit">Confirmer</button>
                </form>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection
</div>
</html>