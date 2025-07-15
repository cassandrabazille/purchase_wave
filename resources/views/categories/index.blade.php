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
      <button class="blackbtn textalignr">Créer un nouvelle catégorie</button>
      </a>
    </div>
    <div class="whitebox">
      <h2 class="padding2">Catégories</h2>
      <p class="subtitle paddingl2 paddingb2">Liste de toutes les catégories enregistrées</p>
      <div class="table-wrapper">
      <table class="orderstable">
        <tr>
        <th>Name</th>
        </tr>
        @foreach ($categories as $category)
      <tr>
      <td>{{$category->name}}</td>
      <td>
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
        <button type="submit" style="background: none; border: none"><img
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