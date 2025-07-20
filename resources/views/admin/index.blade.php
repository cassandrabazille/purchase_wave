@extends('layouts.admin')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
      @if(session('success'))
                    <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-align">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->has('unauthorized'))
                    <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
                        {{ $errors->first('unauthorized') }}
                    </div>
                @endif
    <main class="padding-top-2">
        <div class="black-box-shadow border-radius-1">
                <h2 class="padding-2">Utilisateurs</h2>
                <h3 class="medium-grey-color font-weight-500 padding-left-2 padding-bottom-2">Liste de tous les utilisateurs enregistrés</h3>
                <div>
                    <table class="width-100pct font-size-1-6 border-collapse no-border">
                        <thead>
                            <tr class="grey-background">
                                <th class="font-weight-bold text-align-left padding-1-6-2">Nom complet</th>
                                <th class="font-weight-bold text-align-left padding-1-6-2">Mail</th>
                                <th class="font-weight-bold text-align-left padding-1-6-2">Date de création de compte</th>
                                  <th class="font-weight-bold text-align-left padding-1-6-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-align-left padding-1-6-2 with-bottom-border">{{$user->name}}</td>
                                    <td class="text-align-left padding-1-6-2 with-bottom-border">{{$user->email}}</td>
                                    <td class="text-align-left padding-1-6-2 with-bottom-border">{{$user->created_at}}</td>
                                    <td class="text-align-left padding-1-6-2 with-bottom-border">
                                        <div class="align-items-center gap-1-5">
                                            <form action="{{ route('admin.edit', $user->user_id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none" class="cursor-pointer">
                                                    <img src="{{ asset('images/edit.png') }}"
                                                        alt="Icône crayon pour modifier le compte utilisateur" class="pencil-icon" />
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.destroy', $user->user_id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm ('Supprimer ce compte utilisateur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="cursor-pointer no-border no-background"><img
                                                        src="{{ asset('images/delete.png') }}"
                                                        alt="Icône croix pour supprimer le compte utilisateur" class="delete-icon width-2 height-2" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                        <tr>
                            <td>Aucun utilisateur trouvé</td>
                        </tr>
                        @endforelse
                              </tbody>
                    </table>
                </div>
            </div>
    </main>
    </div>
@endsection