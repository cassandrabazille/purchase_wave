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
                            <span>Return</span>
                        </button>
                    </a>
            </div>
              <div class="justify-center">
            <div class="max-width-70pct border-radius-1 black-box-shadow padding-3">
                <h2 class="margin-bottom-2">Détail du fournisseur</h2>
                <p class="margin-bottom-2">Nom : <strong>{{ $supplier->name }}</strong></p>
                <p class="margin-bottom-2">Mail : <strong>{{ $supplier->email }}</strong></p>
                <p class="margin-bottom-2">Téléphone : <strong>{{ $supplier->telephone }}</strong></p>
                <p class="margin-bottom-2">Adresse : <strong>{{ $supplier->address }}</strong></p>
            </div>
             </div>
        </div>
    </main>
@endsection
</div>
</html>
