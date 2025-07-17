@extends('layouts.guest')

@section('title', 'Page d\'inscription')

@section('content')
    <main class="responsive-register flex-row gap-3 margin-top-2">
        <section>
            <img src="{{ asset('images/connexion.png') }}"
                alt="Image représentant une femme au téléphone devant son ordinateur, elle porte un tailleur beige et a les cheveux roux">
        </section>
        <section class="margin-top-4">
            <h1>Bienvenue sur PurchaseWave !</h1>
            <h3 class="margin-top-2 margin-bottom-3">Inscrivez-vous pour accéder à la plateforme</h3>
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <p class="margin-bottom-2">Nom complet :</p>
                <input type="text" name="name"
                    class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2" />
                <p class="margin-bottom-2">E-mail professionnel :</p>
                <input type="email" name="email"
                    class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2" />
                <p class="margin-bottom-2">Mot de passe :</p>
                <input type="password" name="password"
                    class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2" />
                <p class="margin-bottom-2">Confirmation du mot de passe :</p>
                <input type="password" name="password_confirmation"
                    class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-5" />
                <br>
                <button type=submit
                    class="blue-background width-22 height-6 border-radius-2-5 no-border font-poppins-ss font-size-1-4 white-color hover-blue cursor-pointer">Register</button>
        </section>
    </main>
@endsection