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
        <th>Acheteur*se</th>
        <th>Statut</th>
        <th>Fournisseur</th>
        <th>Montant HT (€)</th>
        <th>Livraison initiale</th>
        <th>Livraison confirmée</th>
        <th>Actions</th>
        </tr>
        @foreach ($orders as $order)
      <tr>
      <td>{{$order->reference}}</td>
      <td>{{date('d/m/Y', strtotime($order->order_date))}}</td>
      <td>{{$order->user?->name ?? 'N/A'}}</td>
      <td>{{$order->status}}</td>
      <td>{{$order->supplier?->name ?? 'N/A'}}</td>
      <td>{{number_format($order->order_amount, 2, ',', ' ')}}</td>
      <td>{{ $order->expected_delivery_date ? date('d/m/Y', strtotime($order->expected_delivery_date)) : 'N/A' }}
      </td>
      <td>
        {{ $order->confirmed_delivery_date ? date('d/m/Y', strtotime($order->confirmed_delivery_date)) : 'N/A' }}
      </td>
      <td>
        <div class="crudline flexrow">
        <form action="{{ route('orders.show', $order->id) }}" method="GET" style="display: inline;">
        <button type="submit" style=" background: none; border: none">
        <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour voir le détail de la commande" />
        </button>
        </form>
        <form action="{{ route('orders.edit', $order->id) }}" method="GET" style="display: inline;">
        <button type="submit" style=" background: none; border: none">
        <img src="{{ asset('images/edit.png') }}" alt="Icône crayon pour modifier la commande" />
        </button>
        </form>
        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline"
        onsubmit="return confirm ('Supprimer cette commande ?');">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: none; border: none"><img
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