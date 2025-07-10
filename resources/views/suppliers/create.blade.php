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

</html>