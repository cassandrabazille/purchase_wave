@extends('layouts.guest')

@section('title', 'Page d\'inscription')

@section('content')
    <main class="flexrow paddingt2">
        <section class="section1">
            <img src="{{ asset('images/connexion.png') }}" alt="Image Connexion" class="imgpp">
        </section>
        <section class="section2">
            <h1 class="paddingt2 marginb3">Bienvenue sur PurchaseWave !</h1>
            <h3 class="paddingt2 marginb3">Inscrivez-vous pour accéder à la plateforme</h3>

            <form method="POST" action="{{ route('auth.register') }}">
                @csrf

                <p class="name marginb2">Nom complet :</p>
                <input type="text" name="name" class="greyspace marginb3" />

                <p class="email marginb2">E-mail professionnel :</p>
                <input type="email" name="email" class="greyspace marginb3" />

                <p class="password marginb2">Mot de passe :</p>
                <input type="password" name="password" class="greyspace marginb3" />

                <p class="password marginb2">Confirmation du mot de passe :</p>
                <input type="password" name="password_confirmation" class="greyspace marginb3" />
                <p class="password marginb2">Rôle :
                    <select name="role" class="marginb2">
                        <option value="purchaser">Purchaser</option>
                        <option value="admin">Admin</option>
                    </select>
                </p>
                <button type=submit class="margint25">Register</button>
        </section>
    </main>
@endsection