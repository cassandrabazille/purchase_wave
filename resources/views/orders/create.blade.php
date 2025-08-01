@extends('layouts.user')

@section('title', 'Page de connexion')

@section('content')

    <div class="container">
        <!-- Affichage des alertes liées aux actions de l'utilisateur -->
        @include('layouts.alerts')

        <div class="padding-top-2">

            <div>

                <!-- Bouton de retour vers la page précédente -->
                <div class="justify-flex-end padding-2">
                    <a href="{{ url()->previous() }}"
                        class="responsive-button black-background white-color font-size-1-4 text-align-right width-11-7 height-4-4 cursor-pointer border-radius-1 no-border black-box-shadow align-items-center gap-1 flex items-center">
                        <img src="{{ asset('images/return.png') }}"
                            alt="Flèche indiquant la possibilité de revenir à la page précédente."
                            class="object-fit-contain padding-left-2 width-4 height-4">
                        <span>Return</span>
                    </a>
                </div>

                <div class="flex-row justify-center">
                    <div class="box-responsive text-align-center border-radius-1 black-box-shadow padding-3 width-27-5">
                        
                        <!-- Formulaire de création d'une commande -->
                        <h2 class="padding-bottom-3">Création de la commande</h2>

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf

                            <!-- Champ : sélection du fournisseur -->
                            <p class="margin-bottom-2">Fournisseur :
                                <select name="supplier_id"
                                    class="text-align-center margin-bottom-2 black-background white-color border-radius-0-6 width-11 height-3 no-border"
                                    required>
                                    <option value="">-- Sélectionnez un fournisseur --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </p>

                            <!-- Champ : sélection de la date de livraison attendue -->
                            <label for="expected_delivery_date" class="padding-bottom-2">Date de livraison : 
                                <input type="date" id="expected_delivery_date" name="expected_delivery_date"
                                    min="{{ now()->format('Y-m-d') }}" class="form-control">
                            </label>

                            <!-- Bouton de validation du formulaire -->
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
