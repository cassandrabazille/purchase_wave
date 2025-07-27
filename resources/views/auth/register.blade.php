@extends('layouts.guest')

@section('title', 'Page d\'inscription')

@section('content')


    <div class="container">

        @if ($errors->any())
            <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-center ">
                <ul class="no-list-style">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="responsive-register flex-row gap-3 margin-top-2">

            <div>
                <img src="{{ asset('images/connexion.png') }}" alt="">
            </div>

            <div class="margin-top-4">

                <h1>Bienvenue sur PurchaseWave</h1>

                <h3 class="margin-top-2 margin-bottom-3">Inscrivez-vous pour accéder à la plateforme</h3>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <label for="name" class="margin-bottom-2 display-block">Nom complet :</label>
                    <input type="text" id="name" name="name"
                        class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2">

                    <label for="email" class="margin-bottom-2 display-block">E-mail professionnel :</label>
                    <input type="email" id="email" name="email"
                        class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2">

                    <label for="password" class="margin-bottom-2 display-block">Mot de passe :</label>
                    <input type="password" id="password" name="password"
                        class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2">

                    <label for="password_confirmation" class="margin-bottom-2 display-block">Confirmation du mot de passe :</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-5">

                    <div class="responsive-confirm-btn">
                        <button type=submit
                            class="responsive-button justify-center align-items-center blue-background width-22 height-6 border-radius-2-5 no-border font-poppins-ss font-size-1-4 white-color hover-blue cursor-pointer">Register</button>
                    </div>

                </form>  

            </div>

        </div>

    </div>
@endsection