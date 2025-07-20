@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
    <main class="padding-top-2">
        <div>
                              @if(session('success'))
                    <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-align">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="justify-flex-end padding-2">
        <a href="{{ url()->previous() }}">
                        <button class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 ">
                            <img src="{{ asset('images/return.png') }}" alt="Flèches de retour"
                                class="object-fit-contain padding-left-2 width-4 height-4" />
                            <span>Return</span>
                        </button>
                    </a>
            </div>
            
    </div>
            <div class="border-radius-1 black-box-shadow padding-3">
                  <div>
                    <div class="justify-flex-end padding-bottom-2">
      <a href={{route('orderitems.create', ['order_id'=>$order->id])}}>
      <button class="responsive-button black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une ligne de commande</button>
      </a>
      </div>
                <h2 class="padding-bottom-2">Détail de la commande </h2>
                

         <p class="padding-bottom-2">
    La commande <strong>{{ $order->reference }}</strong> (statut : <strong>{{ $order->status }}</strong>), fournie par <strong>{{ $order->supplier->name }}</strong>, 
    était initialement prévue pour le <strong>{{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('d/m/Y') }}</strong>
    @if ($order->confirmed_delivery_date)
        et a été confirmée pour le <strong>{{ \Carbon\Carbon::parse($order->confirmed_delivery_date)->format('d/m/Y') }}</strong>.
    @else
        et n’a pas encore de date de livraison confirmée.
    @endif
</p>


                <div class="padding-bottom-2">
                    <table class="width-100pct font-size-1-6 border-collapse no-border">
                        <thead>
                            <tr class="grey-background">
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Ref. produit</th>
                                <th class="hide-mobile font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Prix unitaire (en €)</th>
                                <th class="hide-mobile font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Quantité</th>
                                <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Total de la ligne</th>
                                 <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($orderitems as $orderitem)
                  
                                <tr>
                                    <td class="text-align-left padding-1-6-2 with-bottom-border">{{$orderitem->product->reference}}</td>
                                    <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">{{number_format($orderitem->unit_price, 2, ',', ' ')}} €</td>
                                      <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">{{$orderitem->quantity}}</td>
                                    <td class="text-align-left padding-1-6-2 with-bottom-border">{{number_format($orderitem->line_total, 2, ',', ' ')}} €</td>
                                    <td class="text-align-left padding-1-6-2 with-bottom-border">
                                        <div class="align-items-center gap-1-5">
                                            <form action="{{ route('products.show', $orderitem->product->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/view.png') }}"
                                                        alt="Icône oeil pour voir le détail de la ligne de commande"class="cursor-pointer eye-icon">
                                                </button>
                                            </form>
                                            <form action="{{ route('orderitems.edit', $orderitem->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" style=" background: none; border: none">
                                                    <img src="{{ asset('images/edit.png') }}"
                                                        alt="Icône crayon pour modifier la ligne de commande" class="cursor-pointer pencil-icon"/>
                                                </button>
                                            </form>
                                            <form action="{{ route('orderitems.destroy', $orderitem) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm ('Supprimer cette ligne de commande ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none"><img
                                                        src="{{ asset('images/delete.png') }}"
                                                        alt="Icône croix pour cette ligne de commande" class="cursor-pointer delete-icon"/>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


<div class="justify-center black-background white-color">
                <p class="font-weight-500">Montant HT : {{number_format($order->order_amount, 2, ',', ' ')}} €</p>
</div>
            </div>
        </div>
    </main>
@endsection
</div>
</html>