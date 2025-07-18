@extends('layouts.user')

@section('title', 'Mon compte - Utilisateur')

@section('content')
    @php
        $user = auth('web')->user();
    @endphp
    <div class="container">
        <main class="padding-top-2">
            <div>
                @if(session('success'))
                    <div
                        style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="justify-flex-end padding-2">
                    <a href="{{ url()->previous() }}">
                        <button
                            class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span>Return</span>
                        </button>
                    </a>
                </div>
                <div class="flex-row justify-center">
                    <div class="border-radius-1 black-box-shadow padding-3 max-width-70pct">
                        <h2 class="padding-bottom-2">Mon compte</h2>
                        <div class="flex-row gap-2">
                           <div class="flex-column justify-flex-end border-radius-1 black-box-shadow padding-3">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="margin-bottom-2">
                                        <label>Nom :</label>
                                        <input type="text" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <label>Mail :</label>
                                        <input type="email" name="email" value="{{ $user->email }}" required>
                                    </div>

                                    <button type="submit"
                                        class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                                </form>
                            </div>

                            <div class="border-radius-1 black-box-shadow padding-3">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('profile.password') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="margin-bottom-2">
                                        <label class>Mot de passe actuel :</label>
                                        <input type="password" name="current_password" required>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <label>Nouveau mot de passe :</label>
                                        <input type="password" name="password" required>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <label>Confirmation du mot de passe :</label>
                                        <input type="password" name="password_confirmation" required>
                                    </div>
                                    <button type="submit"
                                        class="blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection