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
                    <h2 class="padding2">Détail de la catégorie</h2>
                    <p>Nom de la catégorie : {{ $category->name }}</p>
                    <p>Descriptif de la catégorie : {{ $category->description }}</p>
                    <p>Utilisateur qui a créé la catégorie :
                        <strong>{{ $category->user ? $category->user->name : 'Utilisateur inconnu' }}</strong> </p>
                </div>
            </div>
        </main>
@endsection
</div>

</html>