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
                <a href={{route('orderitems.create')}}>
                     <button class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-23-5 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une nouvelle ligne de commande</button>
                </a>
            </div>
            <div class="border-radius-1 black-box-shadow padding-3">
                <h2 class="padding2">Détail de la commande</h2>
                <p class="subtitle paddingl2 paddingb2">Liste de toutes les lignes de commandes enregistrées</p>
                <div class="table-wrapper">
                    <table class="orderstable">
                        <thead>
                            <tr>
                                <th>Commande associée</th>
                                <th>Produit associé</th>
                                <th>Quantités</th>
                                <th>Prix unitaire</th>
                                <th>Prix total de la ligne de commande</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderitems as $orderitem)
                                <tr>
                                    <td>{{$orderitem->order->reference}}</td>
                                    <td>{{$orderitem->product->reference}}</td>
                                    <td>{{$orderitem->quantity}}</td>
                                    <td>{{$orderitem->unit_price}}</td>
                                    <td>{{$orderitem->line_total}}</td>
                                    <td>
                                        <div class="crudline flexrow">
                                            <form action="{{ route('orderitems.show', $orderitem->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/view.png') }}"
                                                        alt="Icône oeil pour voir le détail de la ligne de commande" />
                                                </button>
                                            </form>
                                            <form action="{{ route('orderitems.edit', $orderitem->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/edit.png') }}"
                                                        alt="Icône crayon pour modifier la ligne de commande" />
                                                </button>
                                            </form>
                                            <form action="{{ route('orderitems.destroy', $orderitem) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm ('Supprimer cette ligne de commande ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="cursor-pointer no-border no-background"><img
                                                        src="{{ asset('images/delete.png') }}"
                                                        alt="Icône croix pour cette ligne de commande" />
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