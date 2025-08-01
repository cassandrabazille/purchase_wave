@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

  <div class="container">

    <div class="padding-top-2">

      <div>
      <!-- Alertes suite aux actions utilisateur -->
        @include('layouts.alerts')

        <!-- Bouton de retour à la page précédente -->
        <div class="justify-flex-end padding-2">
          <a href="{{ url()->previous() }}"
             class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 flex items-center">
            <img src="{{ asset('images/return.png') }}"
                 alt="Flèche indiquant la possibilité de retourner à la page précédente."
                 class="object-fit-contain padding-left-2 width-4 height-4">
            <span>Return</span>
          </a>
        </div>
      </div>

      <!-- Bloc principal avec détails et actions sur la commande -->
      <div class="border-radius-1 black-box-shadow padding-3">

        <!-- Bouton pour créer une nouvelle ligne de commande -->
        <div class="justify-flex-end padding-bottom-2">
          <a href="{{ route('orderitems.create', ['order_id' => $order->id]) }}"
            class="responsive-button black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer display-flex text-decoration-none">
            Créer une ligne de commande
          </a>
        </div>

        <!-- Détail de la commande -->
        <h2 class="padding-bottom-2">Détail de la commande</h2>

        <p class="padding-bottom-2">
          La commande <strong>{{ $order->reference }}</strong> fournie par
          <strong>{{ $order->supplier->name }}</strong> est <strong>{{ $order->status }}</strong>.
          Date de livraison initiale :
          <strong>{{ \Carbon\Carbon::parse($order->expected_delivery_date)->format('d/m/Y') }}</strong>
          @if ($order->confirmed_delivery_date)
            et date confirmée :
            <strong>{{ \Carbon\Carbon::parse($order->confirmed_delivery_date)->format('d/m/Y') }}</strong>.
          @else
            et n’a pas encore de date de livraison confirmée.
          @endif
        </p>

        <!-- Tableau des lignes de commande -->
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
                  <td class="text-align-left padding-1-6-2 with-bottom-border">
                    {{ $orderitem->product->reference }}
                  </td>
                  <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">
                    {{ number_format($orderitem->unit_price, 2, ',', ' ') }} €
                  </td>
                  <td class="hide-mobile text-align-left padding-1-6-2 with-bottom-border">
                    {{ $orderitem->quantity }}
                  </td>
                  <td class="text-align-left padding-1-6-2 with-bottom-border">
                    {{ number_format($orderitem->line_total, 2, ',', ' ') }} €
                  </td>
                  <td class="text-align-left padding-1-6-2 with-bottom-border">
                    <div class="align-items-center gap-1-5">

                      <!-- Voir produit -->
                      <form action="{{ route('products.show', $orderitem->product->id) }}" method="GET" style="display: inline;">
                        <button type="submit" style="background: none; border: none;">
                          <img src="{{ asset('images/view.png') }}"
                            alt="Icône œil pour voir le détail de la ligne de commande."
                            class="cursor-pointer eye-icon">
                        </button>
                      </form>

                      <!-- Modifier ligne de commande -->
                      <form action="{{ route('orderitems.edit', $orderitem->id) }}" method="GET" style="display: inline;">
                        <button type="submit" style="background: none; border: none;">
                          <img src="{{ asset('images/edit.png') }}"
                            alt="Icône crayon pour modifier la ligne de commande."
                            class="cursor-pointer pencil-icon">
                        </button>
                      </form>

                      <!-- Supprimer ligne de commande -->
                      <form action="{{ route('orderitems.destroy', $orderitem) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Supprimer cette ligne de commande ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none;">
                          <img src="{{ asset('images/delete.png') }}"
                            alt="Icône croix pour supprimer cette ligne de commande."
                            class="cursor-pointer delete-icon">
                        </button>
                      </form>

                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Montant total HT -->
        <div class="justify-center black-background white-color">
          <p class="font-weight-500">Montant HT : {{ number_format($order->order_amount, 2, ',', ' ') }} €</p>
        </div>

      </div>

    </div>

  </div>

@endsection



