@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-align">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->has('unauthorized'))
        <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
            {{ $errors->first('unauthorized') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
            <ul class="no-list-style padding-0 margin-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="padding-top-2">
        <div>
            <div class="justify-flex-end padding-2">
                <a href="{{ url()->previous() }}">
                    <button class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                        <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                            class="object-fit-contain padding-left-2 width-4 height-4" />
                        <span>Return</span>
                    </button>
                </a>
            </div>
            <div class="flex-row justify-center">
                <div class="box-responsive text-align-center border-radius-1 black-box-shadow padding-3 max-width-70pct">
                    <h2 class="margin-bottom-3">Création du fournisseur</h2>
                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf

                        <!-- Nom du fournisseur -->
                        <p class="margin-bottom-2">
                            Nom du fournisseur
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                placeholder="Ex: Fournitures Paris"
                            >
                        </p>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Téléphone du fournisseur -->
                        <p class="margin-bottom-2">
                            Téléphone du fournisseur
                            <input 
                                type="text" 
                                name="telephone" 
                                value="{{ old('telephone') }}" 
                                placeholder="+33612345678"
                            >
                        </p>
                        @error('telephone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Mail du fournisseur -->
                        <p class="margin-bottom-2">
                            Mail du fournisseur :
                            <input 
                                type="text" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="exemple@domaine.com"
                            >
                        </p>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Adresse complète du fournisseur -->
                        <p class="margin-bottom-2">
                            Adresse complète du fournisseur :
                            <input 
                                type="text" 
                                name="address" 
                                value="{{ old('address') }}" 
                                placeholder="12 rue du Poteau, 75012 Paris"
                            >
                        </p>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="justify-center">
                            <button 
                                type="submit" 
                                class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer"
                            >
                                Confirmer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
