@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="flexrow paddingt2">

        <div class="cdesachat-container">
            @if(session('success'))
                <div
                    style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="btn-wrapper">
                <a href={{route('products.create')}}>
                    <button class="blackbtn textalignr margin2">Créer un nouveau produit</button>
                </a>
            </div>
            <div class="products-index">
                <h2 class="padding2">Produits</h2>
                <p class="subtitle paddingl2 paddingb2">Liste de tous les produits enregistrés</p>
                <div class="table-wrapper">
                    <table class="orderstable">
                        <thead>
                            <tr class="table-header">
                                <th>Référence</th>
                                 <th>Mots clés</th>
                                <th>Descriptif</th>
                                <th>Date création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->reference}}</td>
                                    <td>{{$product->slug}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <div class="crudline flexrow">
                                            <form action="{{ route('products.show', $product->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/view.png') }}"
                                                        alt="Icône oeil pour voir le détail du produit" />
                                                </button>
                                            </form>
                                            <form action="{{ route('products.edit', $product->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/edit.png') }}"
                                                        alt="Icône crayon pour modifier le produit" />
                                                </button>
                                            </form>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm ('Supprimer ce produit ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none"><img
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
                <!-- etc. -->
            </div>
        </div>

    </main>
    </div>
@endsection

