@extends('layouts.guest')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
@if(session('success'))
    <div class="light-green-background black-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4">
        {{ session('success') }}
    </div>
@endif

{{-- Erreur personnalisée pour login invalide --}}
@if ($errors->has('login'))
    <div class="light-red-background white-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4 text-center margin-bottom-2">
        {{ $errors->first('login') }}
    </div>
@endif

{{-- Erreurs de validation classiques --}}
@if ($errors->any())
    <div class="light-red-background white-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4 text-center margin-bottom-2">
        <ul class="no-list-style">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <main class="responsive-login flex-row gap-3 margin-top-2">
        <section>
            <img src="{{ asset('images/connexion.png') }}"
                alt="Image représentant une femme au téléphone devant son ordinateur, elle porte un tailleur beige et a les cheveux roux">
        </section>
        <section class="margin-top-4">
            <h1>Bienvenue sur PurchaseWave !</h1>
            <h3 class="margin-top-2 margin-bottom-3">Connectez vous pour accéder à la plateforme</h3>
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <p class="margin-bottom-3">E-mail professionnel :</p>
                <input type="email" name="email"
                    class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2" required />
                <p class="margin-bottom-3">Mot de passe :</p>
                <input type="password" name="password"
                    class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-5" required />
                <br>
                <div class="margin-left-10">
                    <button type="submit"
                        class="blue-background width-22 height-6 border-radius-2-5 no-border font-poppins-ss font-size-1-4 white-color margin-bottom-5 hover-blue cursor-pointer">Login</button>
                </div>
            </form>
            <div>
                <a href="{{ route('register') }}">Pas encore inscrit ? Créez votre compte</a>
            </div>
        </section>
    </main>
    </div>
@endsection