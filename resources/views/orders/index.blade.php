@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

  <main class="flexrow paddingt2">
    <div class="cdesachat-container">
    <!-- ici toutes tes autres boîtes, sections, composants -->
    <div class="btn-wrapper">
      <a href={{route('orders.create')}}>
      <button class="blackbtn textalignr">Créer une nouvelle commande</button>
      </a>
    </div>
    <div class="whitebox">
      <h2 class="padding2">Commandes d'achats</h2>
      <p class="subtitle paddingl2 paddingb2">Liste de toutes les commandes d’achats enregistrées</p>
      <div class="table-wrapper">
      <table class="orderstable">
        <tr>
        <th>Reference</th>
        <th>Date cde</th>
        <th>Statut</th>
        <th>Fournisseur</th>
        <th>Montant HT (€)</th>
        <th>Date de livraison</th>
        <th>Actions</th>
        </tr>
        @foreach ($orders as $order)
      <tr>
      <td>{{$order->reference}}</td>
      <td>{{date('d/m/Y', strtotime($order->order_date))}}</td>
      <td>{{$order->status}}</td>
        <td>{{$order->supplier->name ?? 'N/A'}}</td>
        <td>{{number_format($order->order_amount, 2, ',', ' ')}}</td>
      <td>{{ $order->expected_delivery_date ? date('d/m/Y', strtotime($order->expected_delivery_date)) : 'N/A' }}
      </td>
      <td>
        {{ $order->confirmed_delivery_date ? date('d/m/Y', strtotime($order->confirmed_delivery_date)) : 'N/A' }}
      </td>
      <td>
        <div class="crudline flexrow gap14">
        <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour voir le détail de la commande" />
        <img src="{{ asset('images/edit.png') }}" alt="Icône crayon pour modifier la commande" />
        <img src="{{ asset('images/delete.png') }}" alt="Icône croix pour supprimer la commande" />
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