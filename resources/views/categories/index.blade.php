@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

  <main class="flexrow paddingt2">
    <div class="cdesachat-container">
    <!-- ici toutes tes autres boîtes, sections, composants -->
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
        <div class="crudline flexrow gap14">
        <img src="{{ asset('images/edit.png') }}" alt="Icône crayon pour modifier la catégorie" />
        <img src="{{ asset('images/delete.png') }}" alt="Icône croix pour supprimer la catégorie" />
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

</body>

</html>