@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <div class="container">
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
        <main class="padding-top-2">
            <div class="black-box-shadow border-radius-1">
              

                <div class="justify-flex-end padding-3">
                    <a href={{route('products.create')}}>
                        <button
                            class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer
                            un nouveau produit</button>
                    </a>
                </div>
                <h2 class="padding-2">Produits</h2>
                <p class="medium-grey-color padding-left-2 padding-bottom-2">Liste de tous les produits enregistrés</p>
                <div>
                    <table class="width-100pct font-size-1-6 border-collapse no-border">
                        <thead>
                            <tr class="grey-background">
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Référence</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Mots clés associés
                                </th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Date création</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
                                        {{$product->reference}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
                                        {{$product->slug}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
                                        {{$product->created_at}}</td>
                                    <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
                                        <div class="align-items-center gap-1-5">
                                            <form action="{{ route('products.show', $product->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none"
                                                    class="cursor-pointer">
                                                    <img src="{{ asset('images/view.png') }}"
                                                        alt="Icône oeil pour voir le détail du produit" />
                                                </button>
                                            </form>
                                            <form action="{{ route('products.edit', $product->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none"
                                                    class="cursor-pointer">
                                                    <img src="{{ asset('images/edit.png') }}"
                                                        alt="Icône crayon pour modifier le produit" />
                                                </button>
                                            </form>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm ('Supprimer ce produit ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="cursor-pointer no-border no-background"><img
                                                        src="{{ asset('images/delete.png') }}"
                                                        alt="Icône croix pour supprimer le produit" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
@endsection