@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

<div class="container">
  <main class="padding-top-2">
           <div class="black-box-shadow border-radius-1">
       @if(session('success'))
                    <div class="light-green-background black-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4 text-align">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->has('unauthorized'))
                    <div class="light-red-background white-color margin-top-2 border-radius-3-4 padding-3 font-size-1-4">
                        {{ $errors->first('unauthorized') }}
                    </div>
                @endif
     <div class="justify-flex-end padding-3">
      <a href={{route('categories.create')}}>
     <button class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une nouvelle catégorie</button>
      </a>
    </div>

      <h2 class="padding-2">Catégories</h2>
      <p class="medium-grey-color padding-left-2 padding-bottom-2">Liste de toutes les catégories enregistrées</p>
      <div>
      <table class="width-100pct font-size-1-6 border-collapse no-border">
        <tr class="grey-background">
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Name</th>
          <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Mots clés associés</th>
         <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Actions</th>
        </tr>
        @foreach ($categories as $category)
      <tr>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$category->name}}</td>
          <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$category->slug}}</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
        <div class="align-items-center gap-1-5">
        <form action="{{ route('categories.show', $category->id) }}" method="GET" style="display: inline;">
        <button type="submit" style=" background: none; border: none" class="cursor-pointer">
        <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour voir le détail de la catégorie" />
        </button>
        </form>
           <form action="{{ route('categories.edit', $category->id) }}" method="GET" style="display: inline;">
        <button type="submit" style=" background: none; border: none" class="cursor-pointer">
        <img src="{{ asset('images/edit.png') }}" alt="Icône crayon pour modifier la catégorie" />
        </button>
        </form>
        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
        onsubmit="return confirm ('Supprimer cette catégorie?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="cursor-pointer no-border no-background"><img
          src="{{ asset('images/delete.png') }}" alt="Icône croix pour supprimer la catégorie" />
        </button>
        </form>
        </div>
      </td>
      </tr>
      <tr>
    @endforeach
      </table>
      </div>
      <!-- etc. -->
    </div>
    </div>

  </main>
@endsection
</div>
</body>

</html>