@extends('layouts.admin')

@section('title', 'Page de connexion')

@section('content')

    <main class="flexrow paddingt2">

        <div class="black-box-shadow border-radius-1">
            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="whitebox">
                <h2 class="padding2">Utilisateurs</h2>
                <p class="subtitle paddingl2 paddingb2">Liste de tous les utilisateurs enregistrés</p>
                <div class="table-wrapper">
                    <table class="width-100pct font-size-1-6 border-collapse no-border">
                        <thead>
                            <tr class="grey-background">
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Nom complet</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Mail</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Date de création de compte</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$user->name}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$user->email}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$user->created_at}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
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
                                                <button type="submit" class="cursor-pointer no-border no-background"><img
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