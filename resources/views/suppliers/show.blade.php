@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                <a href="{{  url()->previous() }}">
                    <button class="returnbtn textalignr"><img src="{{ asset('images/return.png') }}"
                            alt="Flèches de retour vers la page précédente" />Return</button>
                </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Détail du fournisseur</h2>
                <p>Nom : {{ $supplier->name }}</p>
                <p>Mail : {{ $supplier->email }}</p>
                <p>Téléphone : {{ $supplier->telephone }}</p>
                <p>Adresse : {{ $supplier->address }}</p>
            </div>
        </div>
    </main>
@endsection
</div>
</html>
