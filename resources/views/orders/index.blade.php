@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">

  <main class="flexrow paddingt2">
    <div class="black-box-shadow border-radius-1">
    @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
      {{ session('success') }}
    </div>
    @endif
    <!-- ici toutes tes autres boîtes, sections, composants -->
    <div class="justify-flex-end padding-3">
      <a href={{route('orders.create')}}>
        <button class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une nouvelle commande</button>
      </a>
    </div>

      <h2 class="padding2">Commandes d'achats</h2>
      <p class="medium-grey-color paddingl2 paddingb2">Liste de toutes les commandes d’achats enregistrées</p>
      <div class="table-wrapper">
      <table class="width-100pct font-size-1-6 border-collapse no-border">
        <tr class="grey-background">
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Référence</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Date création</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Acheteur·se</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Statut</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Fournisseur</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Montant</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2 overflow-wrap word-break max-width-12">Livraison initiale</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2 overflow-wrap word-break max-width-12">Livraison confirmée</th>
        <th class="font-size-1-4 font-weight-bold text-align-left padding-1-6-2">Actions</th>
        </tr>
        @foreach ($orders as $order)
      <tr>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$order->reference}}</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{date('d/m/Y', strtotime($order->order_date))}}</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$order->user?->name ?? 'N/A'}}</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$order->status}}</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{$order->supplier?->name ?? 'N/A'}}</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{number_format($order->order_amount, 2, ',', ' ')}} €</td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">{{ $order->expected_delivery_date ? date('d/m/Y', strtotime($order->expected_delivery_date)) : 'N/A' }}
      </td>
      <td class="font-size-1-4 text-align-left padding-1-6-2 with-bottom-border">
        {{ $order->confirmed_delivery_date ? date('d/m/Y', strtotime($order->confirmed_delivery_date)) : 'N/A' }}
      </td>
      <td class="with-bottom-border">
        <div class="crudline align-items-center gap-1-5">
        <a href="{{ route('orders.show', $order->id) }}" class="crud-icon-link">
        <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour voir le détail de la commande" class="width-2 height-2"/> 
        </a>
        <a href="{{ route('orders.edit', $order->id) }}" class="crud-icon-link">
        <img src="{{ asset('images/edit.png') }}" alt="Icône crayon pour modifier la commande" class="width-2 height-2"/>
         </a>
        <form action="{{ route('orders.destroy', $order) }}" method="POST"
        onsubmit="return confirm ('Supprimer cette commande ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="cursor-pointer no-border no-background">
        <img
          src="{{ asset('images/delete.png') }}" alt="Icône croix pour cette commande" class="width-2 height-2" />
        </button>
        </form>
        </div>
      </td>
      </tr>
      <tr>
    @endforeach
      </table>
      </div>
      <!-- etc. -->
    </div>
    </div>

  </main>
@endsection

</div>
</body>

</html>