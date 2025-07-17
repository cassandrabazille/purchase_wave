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
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif

                    <h2 class="padding2">Création de la catégorie</h2>
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <p class="marginb2">Nom de la catégoire : <input type="text" name="name"></p>
                        <p class="marginb2">Descriptif de la catégoire : <input type="text" name="description"></p>
                        <button type="submit">Confirmer</button>
                    </form>

                    <!-- etc. -->
                </div>
            </div>
        </main>
@endsection
</div>

</html>