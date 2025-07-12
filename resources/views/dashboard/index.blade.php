@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

<main class="flexrow paddingt2">
    <div class="cdesachat-container">
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="dashboard-container flexcolumn gap57">
            <div class="title-and-btn">
                <h1>Bonjour, voici votre dashboard !</h1>
            </div>
            <!-- ici toutes tes autres boîtes, sections, composants -->
            <section class="flexrow gap65 marginl45">
                <div class="box1">
                    <h2>Livraisons à venir 🚚</h2>
                    <div class="flexcolumn ">
                        @forelse ($upcoming as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                            <p>{{ $index + 1 }}. {{   $order->reference}}</p>
                            <p>Date : {{ $order->confirmed_delivery_date->format('d/m/Y') }}</p>
                            <p>CA : {{ number_format($order->order_amount, 0, ',', ' ') }} €</p>
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
                            <p>{{ $index + 1 }}. {{   $order->reference}}</p>
                            <p>Retard : {{ $order->days_late}} jours</p>
                            <p>CA : {{ number_format($order->order_amount, 0, ',', ' ') }} €</p>
                        </div>
                        @empty
                        <p>Aucune livraison en retard</p>
                        @endforelse
                    </div>
                </div>
                <div class="box3">
                    <h2 class="padding2">Commandes en attente</h2>
                        <div class="flexcolumn ">
                        @forelse ($latestPendingOrders as $index => $order)
                        <div class="order-{{ $index + 1 }}">
                            <p>{{ $index + 1 }}. {{   $order->reference}} crée le {{ $order->created_at->format('d-m-Y') }}</p>
    
                            <p></p>
                        </div>
                        @empty
                        <p>Aucune commande en attente</p>
                        @endforelse
                    </div>
                    <a href="{{ route('orders.index') }}" class="btn btn--md btn--centered"> Toutes les
                        commandes</a>
                    </a>
                </div>
            </section>
            <section class="flexrow gap65 marginl45">
                <div class="box4">
                    <h2 class="padding2">Statuts des commandes</h2>
                    <p>Commandes en attente de confirmation : {{ $statusCounts['pending']}}</p>
                    <p>Commandes confirmées : {{ $statusCounts['confirmed']}}</p>
                    <p>Commandes livrées : {{ $statusCounts['delivered']}}</p>
                    <p>Commandes annulées : {{ $statusCounts['cancelled']}}</p>
                </div>
                <div class="box5">
                    <h2 class="padding2">Indicateurs mensuels</h2>
                    <p>Nombre de commandes ce mois-ci 🧾 : {{ $totalOrders}}</p>
                    <p>Montant total des commandes 💰 : {{ $totalAmount}} €</p>
                    <p>Montant moyen d’une commande 📊 : {{ $avgAmount}} €</p>
                </div>
                <div class="box6">
                    <h2 class="padding2">Top fournisseurs {{ $currentYear  }}🏆</h2>
                    <div class="flexrow ">
                        @foreach ($topSuppliers as $index => $supplier)
                            <div class="supplier-{{ $index + 1 }}">
                                <p>{{ $index + 1 . '.' . $supplier->supplier->name }}</p>
                                <p>CA : {{ number_format($supplier->total_amount, 0, ',', ' ') }} €</p>
                            </div>

                        @endforeach


                    </div>
                </div>
            </section>
            <!-- etc. -->
        </div>
</main>
@endsection