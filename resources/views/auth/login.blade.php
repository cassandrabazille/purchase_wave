@extends('layouts.guest')

@section('title', 'Page de connexion')

@section('content')
<main class="flexrow paddingt2">
    <section class="section1">
        <img src="{{ asset('images/connexion.png') }}" alt="Image Connexion" class="imgpp">
    </section>
    <section class="section2">
        <h1 class="paddingt2 marginb3">Bienvenue sur PurchaseWave !</h1>
        <h3 class="paddingt2 marginb3">Connectez vous pour accéder à la plateforme</h3>

        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            <p class="email marginb3">E-mail professionnel :</p>
            <input 
                type="email" 
                name="email" 
                class="greyspace marginb3" 
                required
            />

            <p class="password marginb3">Mot de passe :</p>
            <input 
                type="password" 
                name="password" 
                class="greyspace marginb3" 
                required
            />

            <button type="submit" class="margint4 marginb3">Login</button>
        </form>

        <div>
            <a href="{{ route('auth.register') }}">Pas encore inscrit ? Créez votre compte</a>
        </div>
    </section>
</main>
@endsection
