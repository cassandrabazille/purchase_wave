@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                <form action="POST" {{ route('categories.store') }}>
                    <button class="returnbtn textalignr"><img src="{{ asset('images/return.png') }}"
                            alt="Flèches de retour vers la page précédente" />Return</button>
                    </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Création de la catégorie</h2>
                <form action="POST" {{ route('categories.create') }}>
                    <p class="marginb2">Nom de la catégoire : <input type="text"></p>
                    <button type="submit">Confirmer</button>
                </form>c

                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection

</html>