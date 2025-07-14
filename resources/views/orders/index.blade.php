@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

  <main class="flexrow paddingt2">
    <div class="cdesachat-container">
    @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
      {{ session('success') }}
    </div>
    @endif
    <!-- ici toutes tes autres boîtes, sections, composants -->
    <div class="btn-wrapper">
      <a href={{route('orders.create')}}>
      <button class="blackbtn textalignr margin2">Créer une nouvelle commande</button>
      </a>
    </div>
    <div class="order-index">
      <h2 class="padding2">Commandes d'achats</h2>
      <p class="subtitle paddingl2 paddingb2">Liste de toutes les commandes d’achats enregistrées</p>
      <div class="table-wrapper">
      <table class="orderstable">
        <tr class="table-header">
        <th>Référence</th>
        <th>Date création</th>
        <th>Acheteur·se</th>
        <th>Statut</th>
        <th>Fournisseur</th>
        <th>Montant</th>
        <th class="go-to-line">Livraison initiale</th>
        <th class="go-to-line">Livraison confirmée</th>
        <th>Actions</th>
        </tr>
        @foreach ($orders as $order)
      <tr>
      <td>{{$order->reference}}</td>
      <td>{{date('d/m/Y', strtotime($order->order_date))}}</td>
      <td>{{$order->user?->name ?? 'N/A'}}</td>
      <td>{{$order->status}}</td>
      <td>{{$order->supplier?->name ?? 'N/A'}}</td>
      <td>{{number_format($order->order_amount, 2, ',', ' ')}} €</td>
      <td>{{ $order->expected_delivery_date ? date('d/m/Y', strtotime($order->expected_delivery_date)) : 'N/A' }}
      </td>
      <td>
        {{ $order->confirmed_delivery_date ? date('d/m/Y', strtotime($order->confirmed_delivery_date)) : 'N/A' }}
      </td>
      <td>
        <div class="crudline flexrow">
        <a href="{{ route('orders.show', $order->id) }}" class="crud-icon-link">
        <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour voir le détail de la commande" /> 
        </a>
        <a href="{{ route('orders.edit', $order->id) }}" class="crud-icon-link">
        <img src="{{ asset('images/edit.png') }}" alt="Icône crayon pour modifier la commande" />
         </a>
        <form action="{{ route('orders.destroy', $order) }}" method="POST"
        onsubmit="return confirm ('Supprimer cette commande ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="crud-icon-btn">
        <img
          src="{{ asset('images/delete.png') }}" alt="Icône croix pour cette commande" />
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

</body>

</html>