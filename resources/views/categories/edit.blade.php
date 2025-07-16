@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
            <div class="btn-wrapper">
              <a href="{{ url()->previous() }}">
                        <button class="returnbtn text-align-right width-4 height-4 flex items-center">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span class="ml-2">Return</span>
                        </button>
                    </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Modification de la catégorie</h2>
                <form action="{{ route('categories.update', $category->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <p class="marginb2">Nouveau nom de la catégoire : <input type="text" name="name"
                            value="{{ old('name', $category->name) }}"></p>
                    <p class="marginb2">Nouveau descriptif de la catégoire : <input type="text" name="description"
                            value="{{ old('description', $category->description) }}"></p>
                    <button type="submit">Confirmer</button>
                </form>
                <!-- etc. -->
            </div>
        </div>
    </main>
@endsection
</div>
</html>