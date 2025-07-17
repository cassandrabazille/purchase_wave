@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

<div class="container">

<main class="dashboard-responsive flex-column padding-top-2">
    <div>
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif
        <div class="margin-top-2 grey-background border-radius-1 padding-top-2 padding-right-3-5 gap57 width-120">
            <div class="margin-top-2 margin-left-4 space-between">
                <div>
                <h1 class="font-size-3-2">Bonjour <span class="blue-color">{{ $currentUser->name }}</span>, voici votre dashboard !</h1>
                </div>
              <div>
      <a href={{route('orders.create')}}>
      <button class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-27 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer">Créer une nouvelle commande</button>
      </a>
    </div>
    </div>
            <section class="flex-row gap-7 margin-left-4 margin-top-4 " >
                <div class="flex-column align-items-center white-background border-radius-1 height-27 width-38 font-size-1-4">
                    <h2 class="padding-2">Livraisons à venir 🚚</h2>
                    <div class="flex-column ">
                        @forelse ($upcoming as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                           <a href="{{ route('orders.show', $order->id) }}"> <p> <strong>{{$order->reference}}</strong> arrive le {{ $order->confirmed_delivery_date->format('d/m/Y') }}</p></a>
                        </div>
                        @empty
                        <p>Aucune livraison prévue</p>
                        @endforelse
                    </div>
                </div>
                <div class="flex-column align-items-center white-background border-radius-1 height-27 width-38 font-size-1-4">
                    <h2 class="padding-2 flex-nowrap ">Commandes en retard</h2>
                     <div class="flex-column ">
                        @forelse ($lateDeliveries as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                            <a href="{{ route('orders.show', $order->id) }}"> <p><strong>{{$order->reference}} </strong> a <span class="red-color"><strong>{{ $order->days_late}} jours</strong></span> de retard </p></a>
                        </div>
                        @empty
                        <p>Aucune livraison en retard</p>
                        @endforelse
                    </div>
                </div>
                <div class="flex-column align-items-center space-between white-background border-radius-1 height-27 width-38 font-size-1-4 padding-2">
                    <h2 class ="marginb2">Commandes en attente</h2>
                        <div class="flex-column ">
                        @forelse ($latestPendingOrders as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                             <a href="{{ route('orders.show', $order->id) }}"> <p><strong> {{$order->reference}}</strong> crée le {{ $order->created_at->format('d-m-Y') }}</p></a>
                            <p></p>
                        </div>
                        @empty
                        <p>Aucune commande en attente</p>
                        @endforelse
                    </div>
                    <div class="all-orders-btn">
                    <a href="{{ route('orders.index') }}" class="black-background white-color font-poppins-ss font-size-1-4 align-items-center justify-center width-22 height-4-4 border-radius-1 black-box-shadow no-border cursor-pointer"> Toutes les
                        commandes</a>
                        </div>
                </div>
            </section>
            <section class="flex-row gap-7 margin-left-4 margin-top-4 padding-bottom-4">
                <div class="white-background border-radius-1 height-27 width-38 font-size-1-4">
                    <h2 class="padding-2">Statuts des commandes</h2>
                    <div class="flex-column align-items-center text-align-center">
                    <div class="flex-row gap-2">
                    <div class="grey-background border-radius-1 padding-1">
                    <p>En attente : <p>{{ $statusCounts['pending']}}</p></p>
                    </div>
                    <div class="black-background white-color border-radius-1 padding-1">
                    <p>Confirmées : <p>{{ $statusCounts['confirmed']}}</p></p>
                    </div>
                    </div>
                       <div class="flex-row gap-2">
                      <div class="border-radius-1 padding-1">
                    <p>Livrées : <p>{{ $statusCounts['delivered']}}</p></p>
                    </div>
                        <div class="border-radius-1 padding-1">
                    <p>Annulées : <p>{{ $statusCounts['cancelled']}}</p></p>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="white-background border-radius-1 height-27 width-38 font-size-1-4">
                    <h2 class="padding-2">Indicateurs mensuels</h2>
                    <div class="flex-column align-items-center gap-2">
                   <p class="grey-background border-radius-1 font-size-1-4 bold-font-weight padding-O-6-1-2">Nombre de commandes passées🧾 : {{ $totalOrders}}</p>
                    <p class="blue-background border-radius-1 font-size-1-4 bold-font-weight padding-O-6-1-2">Montant total acheté 💰 : {{ $totalAmount}} €</p>
                    <p class="black-background white-color border-radius-1 font-size-1-4 bold-font-weight padding-O-6-1-2">Montant moyen d'achat 📊 : {{ $avgAmount}} €</p>
                    </div>
                </div>
                <div class="white-background border-radius-1 height-27 width-38  font-size-1-4">
                    <h2 class="padding-2">Top fournisseurs {{ $currentYear  }}🏆</h2>
                    <p class="italic margin-left-2">par CA</p>
                    <div class="flex-row margin-left-1 margin-top-2 ">
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
        </div>
</main>
</div>
@endsection