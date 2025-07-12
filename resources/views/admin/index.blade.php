@extends('layouts.admin')

@section('title', 'Page de connexion')

@section('content')

    <main class="flexrow paddingt2">

        <div class="cdesachat-container">
            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="whitebox">
                <h2 class="padding2">Utilisateurs</h2>
                <p class="subtitle paddingl2 paddingb2">Liste de tous les utilisateurs enregistrés</p>
                <div class="table-wrapper">
                    <table class="orderstable">
                        <thead>
                            <tr>
                                <th>Nom complet</th>
                                <th>Mail</th>
                                <th>Date de création de compte</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <div class="crudline flexrow">
                                            <form action="{{ route('admin.edit', $user->user_id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/edit.png') }}"
                                                        alt="Icône crayon pour modifier le compte utilisateur" />
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.destroy', $user->user_id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm ('Supprimer ce compte utilisateur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none"><img
                                                        src="{{ asset('images/delete.png') }}"
                                                        alt="Icône croix pour supprimer le compte utilisateur" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                        </tbody>
                        <tr>
                            <td>Aucun utilisateur trouvé</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
                <!-- etc. -->
            </div>
        </div>

    </main>
@endsection