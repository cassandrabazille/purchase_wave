@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

<div class="container">
  <main class="flexrow paddingt2">

    <div class="cdesachat-container">
    @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
      {{ session('success') }}
    </div>
    @endif
    <div class="btn-wrapper">
      <a href={{route('categories.create')}}>
     <button class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une nouvelle catégorie</button>
      </a>
    </div>
    <div class="border-radius-1 black-box-shadow padding-3">
      <h2 class="padding2">Catégories</h2>
      <p class="medium-grey-color paddingl2 paddingb2">Liste de toutes les catégories enregistrées</p>
      <div class="table-wrapper">
      <table class="width-100pct font-size-1-6 border-collapse no-border">
        <tr>
        <th>Name</th>
        </tr>
        @foreach ($categories as $category)
      <tr class="grey-background">
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$category->name}}</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
        <div class="crudline flexrow">
        <form action="{{ route('categories.show', $category->id) }}" method="GET" style="display: inline;">
        <button type="submit" style=" background: none; border: none">
        <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour voir le détail de la catégorie" />
        </button>
        </form>
           <form action="{{ route('categories.edit', $category->id) }}" method="GET" style="display: inline;">
        <button type="submit" style=" background: none; border: none">
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