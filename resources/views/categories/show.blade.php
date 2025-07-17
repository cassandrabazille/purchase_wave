@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <div class="container">
        <main class="flexrow justifycenter paddingt2">
            <div class="lignecdes-container">
                <div class="btn-wrapper">
                      <a href="{{ url()->previous() }}">
                    <button class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
                </div>
                <div class="border-radius-1 black-box-shadow padding-3">
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