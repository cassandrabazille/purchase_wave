@extends('layouts.admin')

@section('title', 'Mon compte - Utilisateur')

@section('content')
 <div class="container"></div>
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

    @php
        $user = auth('admin')->user();
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
                            class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span>Return</span>
                        </button>
                    </a>
                </div>
                <div class="flex-row justify-center">
                    <div class="border-radius-1 black-box-shadow padding-3 max-width-70pct">
                        <h2 class="padding-bottom-2">Mon compte Admin</h2>
                        <div class="responsive-account flex-row gap-2">
                           <div class="flex-column justify-flex-end border-radius-1 black-box-shadow padding-3">
                                <form action="{{ route('admin.profile.update') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="margin-bottom-2">
                                        <p>Nom :
                                        <input type="text" name="name" value="{{ $admin->name }}" required>
                                   </p>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <p>Mail 
                                        <input type="email" name="email" value="{{ $admin->email }}" required>
                                  </p>
                                    </div>
<div class="justify-center">
                                    <button type="submit"
                                        class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                               </div>
                                    </form>
                            </div>

                            <div class="border-radius-1 black-box-shadow padding-3">
                                <form action="{{ route('admin.profile.password') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="margin-bottom-2">
                                        <p>Mot de passe actuel :
                                        <input type="password" name="current_password" required>
                                        </p>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <p>Nouveau mot de passe :
                                        <input type="password" name="password" required>
                                         </p>
                                    </div>
                                    <div class="margin-bottom-2">
                                        <p>Confirmation du mot de passe :
                                        <input type="password" name="password_confirmation" required>
                                        </p>
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
        </main>
    </div>
@endsection