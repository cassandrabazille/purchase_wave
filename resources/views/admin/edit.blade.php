@extends('layouts.admin')

@section('title', 'Page de connexion')

@section('content')

    <div class="container">

        @if (session('success'))
            <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-align">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
                <ul class="no-list-style padding-0 margin-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="padding-top-22">

            <div>

                <div class="justify-flex-end padding-2 text-align-center">
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

                        <h2 class="margin-bottom-2">Modifier les informations</h2>

                        <div class="text-align-center gap-2">

                            <form action="{{ route('admin.update', $user->user_id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="margin-bottom-2">
                                    <label for="name">Nom :
                                        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                                    </label>
                                </div>

                                <div class="margin-bottom-2">
                                    <label for="email">Mail :
                                        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                                    </label>
                                </div>

                                <div class="justify-center">
                                    <button type="submit"
                                        class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Confirmer</button>
                                </div>
                            </form>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection