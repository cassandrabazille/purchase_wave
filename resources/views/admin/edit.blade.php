@extends('layouts.admin')

@section('title', 'Page de connexion')

@section('content')

    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
                   <a href="{{ url()->previous() }}">
                        <button class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Mon compte</h2>
                
                <div class="flex-row gap-2">
                <div class="border-radius-1 black-box-shadow padding-3">
                <form action="{{ route('admin.update',$user->user_id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label> Nom : </label>
                    <input type="text" name="name" value="{{ $user->name }}">
                    <br>
                    <label> Mail : </label>
                    <input type="text" name="email" value="{{ $user->email  }}">
                    <br>

                    <button type="submit">Confirmer</button>
                </form>

                </div>
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

               


                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection

</html>