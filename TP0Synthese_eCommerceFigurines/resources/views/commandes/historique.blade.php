{{-- ========================= --}}
{{-- PAGE : Mes achats --}}
{{-- ========================= --}}
<x-layout titre="TP04 - Mes achats">

    <x-nav />


    <section class="catalog-page container py-4 py-lg-5">

        <div class="catalog-shell mb-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">

                <div>
                    <span class="catalog-tag">Historique</span>
                    <h2 class="h3 fw-bold mb-1">Mes achats</h2>
                    <p class="text-muted mb-0">
                        Consultez vos commandes passées et leur statut.
                    </p>
                </div>

                <div class="catalog-counter">
                    {{ $commandes->count() }} commande{{ $commandes->count() > 1 ? 's' : '' }}
                </div>

            </div>
        </div>

        @forelse ($commandes as $commande)

            <article class=" catalog-shell mb-4">

                <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">

                    <div>
                        <h3 class="h5 fw-bold mb-1">
                            Commande #{{ $commande->id }}
                        </h3>

                        <p class="text-muted small mb-0">
                            Passée le {{ $commande->created_at->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="text-lg-end">
                        <p class="text-muted small mb-1">
                            Livraison prévue :
                            {{ $commande->created_at->copy()->addDays(5)->format('d/m/Y') }}
                        </p>

                        <span
                            class="badge rounded-pill
                            @switch($commande->statut)
                            @case('complete')
                                {{ 'bg-success' }}
                                @break
                            @case('en_attente')
                                    {{ 'bg-warning' }}
                                @break
                            @case('echoue')
                                    {{ 'bg-danger' }}
                                @break
                            @default
                            {{ 'bg-secondary' }}
                            @endswitch
                        ">
                            @switch($commande->statut)
                                @case('complete')
                                    {{ 'Complète' }}
                                @break

                                @case('en_attente')
                                    {{ 'En attente' }}
                                @break

                                @case('echoue')
                                    {{ 'Échouée' }}
                                @break

                                @default
                                    {{ 'N/A' }}
                            @endswitch
                        </span>

                        {{-- solution un peu "Wack", mais sinon etat apparait null et lance une exception --}}
                        @php
                            {{$firstAchat = $commande->achats()->first();}}
                        @endphp
                        <span
                            class="badge rounded-pill
                            @if ($firstAchat) @switch($firstAchat->etat)
                                @case('complete')
                                    {{ 'bg-success' }}
                                    @break
                                @case('en_preparation')
                                        {{ 'bg-warning' }}
                                    @break
                                @case('echoue')
                                        {{ 'bg-danger' }}
                                    @break
                                @default
                                {{ 'bg-secondary' }}
                                @endswitch
                            @else
                                {{ 'bg-secondary' }} @endif
                        ">
                            @if ($firstAchat)
                                @switch($firstAchat->etat)
                                    @case('complete')
                                        {{ 'Complète' }}
                                    @break

                                    @case('en_preparation')
                                        {{ 'En préparation' }}
                                    @break

                                    @case('echoue')
                                        {{ 'Échouée' }}
                                    @break

                                    @default
                                        {{ 'N/A' }}
                                @endswitch
                            @else
                                {{ 'N/A' }}
                            @endif
                        </span>

                    </div>

                </div>

                {{-- Produits --}}
                <div class="table-responsive mb-4">
                    <table class="table align-middle">
                        <thead>
                            <tr class="small text-muted">
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Qté</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($commande->achats as $achat)
                                <tr>
                                    <td>{{ $achat->nom_produit }}</td>
                                    <td>${{ number_format($achat->prix_unitaire / 100, 2, ',', ' ') }}</td>
                                    <td>{{ $achat->quantite }}</td>
                                    <td class="fw-semibold">
                                        ${{ number_format($achat->total / 100, 2, ',', ' ') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Total --}}
                <div class="d-flex justify-content-end">
                    <div class="text-end">
                        <p class="text-muted small mb-1">Montant total</p>
                        <div class="fs-5 fw-bold">
                            ${{ number_format($commande->montant_total / 100, 2, ',', ' ') }}
                        </div>
                    </div>
                </div>

                <a href="#">Plus de details</a>

            </article>

            @empty

                <div class="catalog-panel text-center py-5 px-4">
                    <p class="small text-uppercase text-muted fw-semibold mb-2">
                        Aucun achat
                    </p>

                    <h3 class="h4 mb-2">Vous n'avez encore rien commandé</h3>

                    <p class="text-muted mb-4">
                        Parcourez notre catalogue pour trouver votre prochaine figurine.
                    </p>

                    <a href="{{ route('figurines.index') }}" class="btn btn-primary">
                        Voir le catalogue
                    </a>
                </div>

            @endforelse

        </section>

    </x-layout>
