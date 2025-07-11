@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
    <main class="flexrow justifycenter paddingt2">
        <div class="lignecdes-container">
                          @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
      {{ session('success') }}
    </div>
    @endif
            <div class="btn-wrapper">
     
                <a href="{{  url()->previous() }}">
                    <button class="returnbtn textalignr"><img src="{{ asset('images/return.png') }}"
                            alt="Flèches de retour vers la page précédente" />Return</button>
                </a>
            </div>
              <div class="btn-wrapper">
      <a href={{route('orderitems.create', ['order_id'=>$order->id])}}>
      <button class="blackbtn textalignr">Créer une nouvelle ligne de commande</button>
      </a>
    </div>
            <div class="whitebox">
                <h2 class="padding2">Détail de la commande </h2>

                <p class="subtitle paddingl2 paddingb2">Liste de tous les produits rattachés à la commande
                   <strong>{{ $order->reference }}</strong>  avec le fournisseur <strong>{{ $order->supplier->name}}</strong></p>
                <div class="table-wrapper">
                    <table class="orderstable">
                        <thead>
                            <tr>
                                <th>Ref. produit</th>
                                <th>Prix unitaire (en €)</th>
                                <th>Quantité</th>
                                <th>Total de la ligne</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderitems as $orderitem)
                                <tr>
        
                                    <td>{{$orderitem->product->reference}}</td>
                                    <td>{{$orderitem->unit_price}}</td>
                                      <td>{{$orderitem->quantity}}</td>
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
                                                class="d-inline"
                                                onsubmit="return confirm ('Supprimer cette ligne de commande ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none"><img
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



                <p>Montant HT (€) : {{number_format($order->order_amount, 2, ',', ' ')}}</p>

            </div>
        </div>
    </main>
@endsection

</html>