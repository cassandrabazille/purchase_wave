@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

<main class="flexrow paddingt2">
    <div class="dashboard-index">
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="dashboard-container flexcolumn gap57">
            <div class="title-and-btn">
                <div class="title">
                <h1>Bonjour <span class="username-db">{{ $currentUser->name }}</span>, voici votre dashboard !</h1>
                </div>
              <div class="btn-wrapper btn-create-dashboard">
      <a href={{route('orders.create')}}>
      <button class="blackbtn textalignr ">Créer une nouvelle commande</button>
      </a>
    </div>
    </div>
           
            <!-- ici toutes tes autres boîtes, sections, composants -->
            <section class="flexrow gap65 marginl45">
                <div class="box1">
                    <h2 class="padding2">Livraisons à venir 🚚</h2>
                    <div class="flexcolumn ">
                        @forelse ($upcoming as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                           <a href="{{ route('orders.show', $order->id) }}"> <p> <strong>{{   $order->reference}}</strong> arrive le  {{ $order->confirmed_delivery_date->format('d/m/Y') }}</p></a>
                        </div>
                        @empty
                        <p>Aucune livraison prévue</p>
                        @endforelse
                    </div>
                </div>
                <div class="box2">
                    <h2 class="padding2">Commandes en retard ⚠️</h2>
                     <div class="flexcolumn ">
                        @forelse ($lateDeliveries as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                            <a href="{{ route('orders.show', $order->id) }}"> <p><strong>{{   $order->reference}} </strong> a <span class="red"><strong>{{ $order->days_late}} jours</strong></span> de retard </p></a>
                        </div>
                        @empty
                        <p>Aucune livraison en retard</p>
                        @endforelse
                    </div>
                </div>
                <div class="box3">
                    <h2 class ="marginb2">Commandes en attente</h2>
                        <div class="flexcolumn ">
                        @forelse ($latestPendingOrders as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                             <a href="{{ route('orders.show', $order->id) }}"> <p><strong> {{   $order->reference}}</strong> crée le {{ $order->created_at->format('d-m-Y') }}</p></a>
                            <p></p>
                        </div>
                        @empty
                        <p>Aucune commande en attente</p>
                        @endforelse
                    </div>
                    <div class="all-orders-btn">
                    <a href="{{ route('orders.index') }}" class="blackbtn"> Toutes les
                        commandes</a>
                        </div>
            
                </div>
            </section>
            <section class="flexrow gap65 marginl45">
                <div class="box4">
                    <h2 class="padding2">Statuts des commandes</h2>
                    <div class="status-group">
                    <div class="status-line1">
                    <div class="status-box1">
                    <p>En attente : <p>{{ $statusCounts['pending']}}</p></p>
                    </div>
                    <div class="status-box2">
                    <p>Confirmées : <p>{{ $statusCounts['confirmed']}}</p></p>
                    </div>
                    </div>
                       <div class="status-line2">
                      <div class="status-box3">
                    <p>Livrées : <p>{{ $statusCounts['delivered']}}</p></p>
                    </div>
                        <div class="status-box4">
                    <p>Annulées : <p>{{ $statusCounts['cancelled']}}</p></p>
                    </div>
                    </div>
                    </div>
                </div>
                <div class="box5">
                    <h2 class="padding2">Indicateurs mensuels</h2>
                    <div class="monthly-indicators">
                   <p class="monthly-indicator1">Nombre de commandes passées🧾 : {{ $totalOrders}}</p>
                    <p class="monthly-indicator2">Montant total acheté 💰 : {{ $totalAmount}} €</p>
                    <p class="monthly-indicator3">Montant moyen d'achat 📊 : {{ $avgAmount}} €</p>
                    </div>
                </div>
                <div class="box6">
                    <h2 class="padding2">Top fournisseurs {{ $currentYear  }}🏆</h2>
                    <p class="italic marginl2">par CA</p>
                    <div class="flexrow ">
                        @foreach ($topSuppliers as $index => $supplier)
                            <div class="supplier-{{ $index + 1 }}">
                                <img src="{{ asset('images/fournisseur' . ($index + 1) . '.png') }}" alt="Logo fournisseur {{ $index +1 }}" class="supplier-img">
                                <p>{{$supplier->supplier->name }}</p>
                                <p>{{ number_format($supplier->total_amount, 0, ',', ' ') }} €</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- etc. -->
        </div>
</main>
@endsection