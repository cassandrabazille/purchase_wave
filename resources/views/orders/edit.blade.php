@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

    <div class="container">
        <!-- Affichage des alertes suite aux actions de l'utilisateur -->
        @include('layouts.alerts')


        <!-- Bouton de retour vers la page précédente -->
        <div class="padding-top-2">
            <div>
                <div class="justify-flex-end padding-2">
                    <a href="{{ url()->previous() }}"
                        class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 flex items-center">
                        <img src="{{ asset('images/return.png') }}"
                            alt="Flèche qui indique la possibilité de retourner sur la page précédente."
                            class="object-fit-contain padding-left-2 width-4 height-4">
                        <span>Return</span>
                    </a>
                </div>

                <div class="flex-row justify-center">

                    <div class="box-responsive text-align-center border-radius-1 black-box-shadow padding-3">
                        <!-- Formulaire de modification d'une commande -->
                        <h2 class="padding-bottom-3">Modification de la commande</h2>

                        <form action="{{ route('orders.update', $order->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Champ : sélection du statut -->
                            <p>Statut :
                                <select name="status"
                                    class="text-align-center margin-bottom-2 black-background white-color border-radius-0-6 width-11 height-3 no-border">
                                    <option value="">-- Sélectionnez un statut --</option>
                                    <option value="en attente" {{ old('status', $order->status) === 'en attente' ? 'selected' : '' }}>
                                        En attente
                                    </option>
                                    <option value="expédiée" {{ old('status', $order->status) === 'expédiée' ? 'selected' : '' }}>
                                        Expédiée
                                    </option>
                                    <option value="livrée" {{ old('status', $order->status) === 'livrée' ? 'selected' : '' }}>
                                        Livrée
                                    </option>
                                    <option value="annulée" {{ old('status', $order->status) === 'annulée' ? 'selected' : '' }}>
                                        Annulée
                                    </option>
                                </select>
                            </p>

                            <!-- Champ : sélection de la date de livraison confirmée -->
                            <label for="confirmed_delivery_date" class="margin-bottom-2">Date de livraison confirmée :
                                <input type="date" id="confirmed_delivery_date" name="confirmed_delivery_date"
                                    min="{{ $order->order_date->format('Y-m-d') }}"
                                    value="{{ old('confirmed_delivery_date', $order->confirmed_delivery_date ? $order->confirmed_delivery_date->format('Y-m-d') : '') }}"
                                    class="form-control">
                            </label>

                            <!-- Bouton de soumission du formulaire -->
                            <div class="justify-center">
                                <button type="submit"
                                    class="responsive-button justify-center align-items-center blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">
                                    Confirmer
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
