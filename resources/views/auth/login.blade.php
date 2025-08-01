@extends('layouts.guest')

@section('title', 'Page de connexion')

@section('content')

    <div class="container">

        @if(session('success'))
            <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('login'))
            <div
                class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-center margin-bottom-2">
                {{ $errors->first('login') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-center margin-bottom-2">
                <ul class="no-list-style">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="responsive-login flex-row align-items-center gap-3 margin-top-2">
            <div>
                <img src="{{ asset('images/connexion.png') }}" alt="">
            </div>

            <div class="margin-top-4">

                <h1>Bienvenue sur PurchaseWave</h1>

                <h3 class="margin-top-2 margin-bottom-3">Connectez vous pour accéder à la plateforme</h3>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <label for="email" class="display-block margin-bottom-3">E-mail professionnel :</label>
                    <input type="email" id="email" name="email"
                        class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-2" required>

                    <label for="password" class="margin-bottom-3 display-block">Mot de passe :</label>
                    <input type="password" id="password" name="password"
                        class="width-51-1 height-6 border-radius-0-6 grey-background margin-bottom-5" required>

                    <div class="responsive-confirm-btn">
                        <button type="submit"
                            class="justify-center align-items-center blue-background width-22 height-6 border-radius-2-5 no-border font-poppins-ss font-size-1-4 white-color margin-bottom-5 hover-blue cursor-pointer">Login</button>
                    </div>
                </form>

                <div>
                    <a href="{{ route('register') }}">Pas encore inscrit ? Créez votre compte</a>
                </div>

            </div>

        </div>

    </div>
@endsection