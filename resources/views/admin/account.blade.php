@extends('layouts.admin')

@section('title', 'Mon compte - Admin')

@section('content')
    @php
        $admin = auth('admin')->user();
    @endphp
    <div class="container">
        <main class="flexrow justifycenter paddingt2">
            <div class="lignecdes-container">
                @if(session('success'))
                    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="btn-wrapper">
                    <a href="{{ url()->previous() }}">
                        <button class="returnbtn textalignr">
                            <img src="{{ asset('images/return.png') }}" alt="Retour" />Return
                        </button>
                    </a>
                </div>
                <div class="whitebox">
                    <h2 class="padding2">Mon compte (Admin)</h2>

                    <div class="forms-container">
                        <div class="form-column whitebox">
                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label>Nom :</label>
                                    <input type="text" name="name" value="{{ $admin->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Mail :</label>
                                    <input type="email" name="email" value="{{ $admin->email }}" required>
                                </div>

                                <button type="submit" class="margin2">Confirmer</button>
                            </form>
                        </div>

                        <div class="form-column whitebox">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.profile.password') }}" method="POST">
                                @csrf
                                @method('POST')

                                <label>Mot de passe actuel :</label>
                                <input type="password" name="current_password" required>
                                <br>
                                <label>Nouveau mot de passe :</label>
                                <input type="password" name="password" required>
                                <br>
                                <label>Confirmation du mot de passe :</label>
                                <input type="password" name="password_confirmation" required>
                                <br>

                                <button type="submit" class="margin2">Confirmer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
