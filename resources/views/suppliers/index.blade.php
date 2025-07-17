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
                <a href={{route('suppliers.create')}}>
                    <button class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer un nouveau fournisseur</button>
                </a>
            </div>
            <div class="border-radius-1 black-box-shadow padding-3">
                <h2 class="padding2">Fournisseurs</h2>
                <p class="medium-grey-color paddingl2 paddingb2">Liste de tous les fournisseurs enregistrés</p>
                <div class="table-wrapper">
                    <table class="width-100pct font-size-1-6 border-collapse no-border">
                        <thead>
                            <tr>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Nom</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Mail</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Téléphone</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Adresse</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$supplier->telephone}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$supplier->address}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
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
                                                <button type="submit" class="cursor-pointer no-border no-background"><img
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
</div>