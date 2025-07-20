@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')
<div class="container">
  <main class="padding-top-2">
    <div class="black-box-shadow border-radius-1">
          @if(session('success'))
                    <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4 text-align">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->has('unauthorized'))
                    <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
                        {{ $errors->first('unauthorized') }}
                    </div>
                @endif
                  @if ($errors->any())
    <div class="light-red-background white-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
        <ul class="no-list-style padding-0 margin-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- ici toutes tes autres boîtes, sections, composants -->
    <div class="justify-flex-end padding-3">
      <a href={{route('orders.create')}}>
        <button class="responsive-button black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une nouvelle commande</button>
      </a>
    </div>
      <h2 class="padding-2">Commandes d'achats</h2>
      <h3 class="medium-grey-color padding-left-2 font-weight-500 padding-bottom-2">Liste de toutes les commandes d’achats enregistrées</h3>
      <div>
      <table class="width-100pct font-size-1-6 border-collapse no-border">
        <tr class="grey-background">
        <th class="font-weight-bold text-align-left padding-1-6-2">Référence</th>
        <th class="hide-mobile hide-tablet font-weight-bold text-align-left padding-1-6-2">Date création</th>
        <th class="hide-mobile hide-tablet font-weight-bold text-align-left padding-1-6-2">Acheteur·se</th>
        <th class="font-weight-bold text-align-left padding-1-6-2">Statut</th>
        <th class="hide-mobile font-weight-bold text-align-left padding-1-6-2">Fournisseur</th>
        <th class="hide-mobile font-weight-bold text-align-left padding-1-6-2">Montant</th>
        <th class="hide-mobile font-weight-bold text-align-left padding-1-6-2 overflow-wrap word-break max-width-12">Livraison initiale</th>
        <th class="hide-mobile font-weight-bold text-align-left padding-1-6-2 overflow-wrap word-break max-width-12"><span class="max-2-lines">Livraison confirmée</span></th>
        <th class="font-weight-bold text-align-left padding-1-6-2">Actions</th>
        </tr>
        @foreach ($orders as $order)
      <tr>
      <td class="text-align-left padding-1-6-2 with-bottom-border">{{$order->reference}}</td>
      <td class="hide-mobile hide-tablet text-align-left padding-1-6-2 with-bottom-border">{{date('d/m/Y', strtotime($order->order_date))}}</td>
      <td class="hide-mobile hide-tablet text-align-left padding-1-6-2 with-bottom-border">{{$order->user?->name ?? 'N/A'}}</td>
      <td class="text-align-left padding-1-6-2 with-bottom-border">{{$order->status}}</td>
      <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">{{$order->supplier?->name ?? 'N/A'}}</td>
      <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">{{number_format($order->order_amount, 2, ',', ' ')}} €</td>
      <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">{{ $order->expected_delivery_date ? date('d/m/Y', strtotime($order->expected_delivery_date)) : 'N/A' }}
      </td>
      <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">
        {{ $order->confirmed_delivery_date ? date('d/m/Y', strtotime($order->confirmed_delivery_date)) : 'N/A' }}
      </td>
      <td class="with-bottom-border">
        <div class="align-items-center gap-1-5">
        <a href="{{ route('orders.show', $order->id) }}" class="cursor-pointer">
        <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour voir le détail de la commande" class="eye-icon"/> 
        </a>
        <a href="{{ route('orders.edit', $order->id) }}" class="cursor-pointer">
        <img src="{{ asset('images/edit.png') }}" alt="Icône crayon pour modifier la commande" class="pencil-icon"/>
         </a>
        <form action="{{ route('orders.destroy', $order) }}" method="POST"
        onsubmit="return confirm ('Êtes-vous sûr(e) de vouloir supprimer cette commande ? La suppression \'une commande entraîne la perte de toutes les lignes de commandes et informations associées. ');">
        @csrf
        @method('DELETE')
        <button type="submit" class="cursor-pointer no-border no-background">
        <img
          src="{{ asset('images/delete.png') }}" alt="Icône croix pour cette commande" class="delete-icon width-2 height-2" />
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