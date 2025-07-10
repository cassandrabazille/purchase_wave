@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

    <main class="flexrow paddingt2">

        <div class="cdesachat-container">
            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="btn-wrapper">
                <a href={{route('suppliers.create')}}>
                    <button class="blackbtn textalignr">Créer un nouveau fournisseur</button>
                </a>
            </div>
            <div class="whitebox">
                <h2 class="padding2">Fournisseurs</h2>
                <p class="subtitle paddingl2 paddingb2">Liste de tous les fournisseurs enregistrés</p>
                <div class="table-wrapper">
                    <table class="orderstable">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Mail</th>
                                <th>Téléphone</th>
                                <th>Adresse</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{$supplier->name}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->telephone}}</td>
                                    <td>{{$supplier->address}}</td>
                                    <td>
                                        <div class="crudline flexrow">
                                            <form action="{{ route('suppliers.show', $supplier->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/view.png') }}"
                                                        alt="Icône oeil pour voir le détail du fournisseur" />
                                                </button>
                                            </form>
                                            <form action="{{ route('suppliers.edit', $supplier->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/edit.png') }}"
                                                        alt="Icône crayon pour modifier le fournisseur" />
                                                </button>
                                            </form>
                                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm ('Supprimer ce fournisseur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none"><img
                                                        src="{{ asset('images/delete.png') }}"
                                                        alt="Icône croix pour supprimer le fournisseur" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- etc. -->
            </div>
        </div>

    </main>
@endsection