@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                <a href="{{  url()->previous() }}">
                    <button class="returnbtn textalignr"><img src="{{ asset('images/return.png') }}"
                            alt="Flèches de retour vers la page précédente" />Return</button>
                </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Mon compte</h2>
                
                <div class="forms-container">
                <div class="form-column whitebox">
                <form action="{{ route('profile.account.infos') }}" method="POST">
                    @csrf
                    @method('PATCH')
                        <div class="form-group">
                    <label> Nom : </label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}">
                     </div>
                       <div class="form-group">
                    <label> Mail : </label>
                    <input type="text" name="email" value="{{ auth()->user()->email  }}">
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

                <form action="{{ route('profile.account.password') }}" method="POST">
                    @csrf
                       @method('PATCH')

                    <label> Mot de passe actuel : </label>
                    <input type="password" name="current_password" required>
                    <br>
                    <label> Nouveau mot de passe : </label>
                    <input type="password" name="password" required>
                    <br>
                    <label> Confirmation de mot de passe : </label>
                    <input type="password" name="password_confirmation" required>
                    <br>

                    <button type="submit" class="margin2">Confirmer</button>
                </form>
</div>
</div>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection

</html>