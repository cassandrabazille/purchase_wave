@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

<div class="container">
@if(session('success'))
    <div class="light-green-background black-color margin-top-2 border-radius-1 padding-3 font-size-1-4">
        {{ session('success') }}
    </div>
@endif
<main class="dashboard-responsive flex-column padding-top-2 grey-background border-radius-1 margin-top-2 padding-top-2 padding-right-3-5 gap57 width-12 ">
            <div class="responsive-title-and-btn space-between align-items-center padding-top-2">
                <div>
                <h1 class="margin-left-4">Bonjour <span class="blue-color">{{ $currentUser->name }}</span>, voici votre dashboard !</h1>
                </div>
              <div>
      <a href={{route('orders.create')}}>
      <button class="responsive-button black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une nouvelle commande</button>
      </a>
    </div>
    </div>
   <section class="flex-row gap-7 margin-left-4">
    {{-- Commandes en attente --}}
    <div class="flex-column align-items-center space-between white-background border-radius-1 height-32 width-38 font-size-1-4">
        <h2 class="margin-top-2 margin-bottom-2">Commandes en attente</h2>
        <div class="responsive-data flex-column gap-1">
            @forelse ($latestPendingOrders as $index => $order)
                <div class="order-{{ $index + 1 }}">
                    <a href="{{ route('orders.show', $order->id) }}" class="flex-row align-items-center gap-1">
                         <img src="{{ asset('images/view.png') }}" alt="Icône oeil pour aller voir le détail commande" class="eye-icon" />
                    <p><strong>{{ $order->reference }}</strong> du {{ $order->created_at->format('d-m-Y') }}</p>
                    </a>
                </div>
            @empty
                <p>Aucune commande en attente</p>
            @endforelse
        </div>

        <div class="all-orders-btn margin-top-2 margin-bottom-2">
            <a href="{{ route('orders.index') }}" class="responsive-button black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-22 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">
                Toutes les commandes
            </a>
        </div>
    </div>

    {{-- Commandes en retard --}}
    <div class="flex-column align-items-center white-background border-radius-1 height-32 width-38 font-size-1-4">
        <h2 class="margin-bottom-2 margin-top-2">Non expédiées - en retard</h2>
        <p class="margin-bottom-2 italic">En attente de date de confirmation</p>
       
        <div class="responsive-data flex-column gap-1">
         
            @forelse ($lateDeliveries as $index => $order)
                <div class="order-{{ $index + 1 }}">
                    <a href="{{ route('orders.show', $order->id) }}"  class="flex-row align-items-center gap-1">
                         <img src="{{ asset('images/view.png') }}" alt="Icône œil pour voir le détail de la commande" class="eye-icon" />
                        <p><strong>{{ $order->reference }}</strong> a <span class="red-color"><strong>{{ $order->days_late }} jours</strong></span> de retard</p>
                    </a>
                </div>
            @empty
                <p>Aucune livraison en retard</p>
            @endforelse
        </div>
    </div>

    {{-- Livraisons à venir --}}
    <div class="flex-column align-items-center white-background border-radius-1 height-32 width-38 font-size-1-4">
        <h2 class="margin-bottom-2 margin-top-2">Livraisons à venir 🚚</h2>
        <div class="responsive-data flex-column gap-1">
            @forelse ($upcoming as $index => $order)
                <div class="order-{{ $index + 1 }}">
                    <a href="{{ route('orders.show', $order->id) }}" class="flex-row align-items-center gap-1">
                            <img src="{{ asset('images/view.png') }}" alt="Icône œil pour voir le détail de la commande" class="eye-icon" />
                        <p><strong>{{ $order->reference }}</strong> arrive le {{ $order->confirmed_delivery_date->format('d/m/Y') }}</p>
                    </a>
                </div>
            @empty
                <p>Aucune livraison prévue</p>
            @endforelse
        </div>
    </div>
</section>

            <section class="flex-row gap-7 margin-left-4 margin-top-4 padding-bottom-4">
                <div class="white-background border-radius-1 height-32 width-38 font-size-1-4">
                    <h2 class="margin-bottom-2 margin-top-2 text-align-center">Statuts des commandes</h2>
                    <div class="flex-column align-items-center text-align-center">
                    <div class="flex-row gap-2">
                    <div class="grey-background border-radius-1 padding-1">
                    <p>En attente : <p>{{ $statusCounts['en attente']}}</p></p>
                    </div>
                    <div class="black-background white-color border-radius-1 padding-1">
                    <p>Expédiée : <p>{{ $statusCounts['expédiée']}}</p></p>
                    </div>
                    </div>
                       <div class="flex-row gap-2">
                      <div class="border-radius-1 padding-1">
                    <p>Livrées : <p>{{ $statusCounts['livrée']}}</p></p>
                    </div>
                        <div class="border-radius-1 padding-1">
                    <p>Annulées : <p>{{ $statusCounts['annulée']}}</p></p>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="white-background border-radius-1 height-32 width-38 font-size-1-4">
                    <h2 class="margin-bottom-2 text-align-center margin-top-2">Indicateurs mensuels</h2>
                    <div class="flex-column align-items-center gap-2">
                   <p class="grey-background border-radius-1 font-size-1-4 bold-font-weight padding-O-6-1-2">Nombre de commandes passées🧾 : {{ $totalOrders}}</p>
                    <p class="blue-background white-color border-radius-1 font-size-1-4 bold-font-weight padding-O-6-1-2">Montant total acheté 💰 : {{ number_format($totalAmount, 2) }} €</p>
                    <p class="black-background white-color border-radius-1 font-size-1-4 bold-font-weight padding-O-6-1-2">Montant moyen d'achat 📊 : {{ number_format($avgAmount, 2) }} €</p>
                    </div>
                </div>
                <div class="white-background border-radius-1 height-32 width-38  font-size-1-4">
                    <h2 class="margin-bottom-2 margin-top-2 text-align-center">Top fournisseurs {{ $currentYear  }}🏆</h2>
                    <p class="italic margin-left-2">par CA</p>
                    <div class="flex-row margin-top-2 padding-right-2 ">
                        @foreach ($topSuppliers as $index => $supplier)
                            <div class="supplier-{{ $index + 1 }} flex-column align-items-center text-align-center gap-0-5">
                                <img src="{{ asset('images/fournisseur' . ($index + 1) . '.png') }}" alt="Logo fournisseur {{ $index +1 }}" class="width-4 height-4">
                                <p>{{$supplier->supplier->name }}</p>
                                <p>{{ number_format($supplier->total_amount, 0, ',', ' ') }} €</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
</main>
</div>
@endsection