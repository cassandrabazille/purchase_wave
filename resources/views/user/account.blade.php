@extends('layouts.user')

@section('title', 'Mon compte - Utilisateur')

@section('content')
    @php
        $user = auth('web')->user();
    @endphp
    <div class="container">
        <div class="padding-top-2">
            <div>
                @if(session('success'))
                    <div class="light-green-background black-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="light-red-background white-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="light-red-background white-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4">
                        <ul class="no-list-style">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="justify-flex-end padding-2">
                    <a href="{{ url()->previous() }}"
                        class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 flex items-center">
                        <img src="{{ asset('images/return.png') }}"
                            alt="Flèche qui indique la possibilité de retourner sur la page précédente."
                            class="object-fit-contain padding-left-2 width-4 height-4">
                        <span>Return</span>
                    </a>
                </div>
                <div class="flex-row justify-center">
                    <div class="border-radius-1 black-box-shadow padding-3 max-width-70pct">
                        <h2 class="padding-bottom-2">Mon compte</h2>
                        <div class="responsive-account flex-row gap-2">
                            <div class="flex-column justify-flex-end border-radius-1 black-box-shadow padding-3">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="margin-bottom-2">
                                        <label for="name">Nom :
                                            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                                        </label>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <label for="mail">Mail :
                                            <input type="email" id="mail" name="email" value="{{ $user->email }}" required>
                                        </label>
                                    </div>
                                    <button type="submit"
                                        class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                                </form>
                            </div>

                            <div class="border-radius-1 black-box-shadow padding-3">
                                <form action="{{ route('profile.password') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="margin-bottom-2">
                                        <label for="current_password" class="display-block">Mot de passe actuel :
                                            <input type="password" id="current_password" name="current_password" required>
                                        </label>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <label for="password" class="display-block">Nouveau mot de passe :
                                            <input type="password" id="password" name="password" required>
                                        </label>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <label for="password_confirmation" class="display-block">Confirmation du mot de passe :
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                required>
                                        </label>
                                    </div>
                                    <div class="justify-center">
                                        <button type="submit"
                                            class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection