@extends('layouts.admin')

@section('title', 'Page de connexion')

@section('content')

    <main class="padding-top-22">
        <div>
            <div class="justify-flex-end padding-2">
                   <a href="{{ url()->previous() }}">
                        <button class="black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span>Return</span>
                        </button>
                    </a>
            </div>
      <div class="flex-row justify-center">
            <div class="border-radius-1 black-box-shadow padding-3 max-width-70pct">
                <h2 class="margin-bottom-2">Modifier les informations</h2>
                
                <div class="flex-row gap-2">
               
                <form action="{{ route('admin.update',$user->user_id) }}" method="POST">
                    @csrf
                    @method('PATCH')
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
    </main>
@endsection

</html>