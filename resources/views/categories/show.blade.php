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
                <h2 class="padding2">Détail de la catégorie</h2>
                <p>Nom de la catégorie : {{ $category->name }}</p>
                <p>Descriptif de la catégorie : {{ $category->description }}</p>
            </div>
        </div>
    </main>
@endsection
</div>
</html>