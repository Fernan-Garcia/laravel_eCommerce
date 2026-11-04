<x-layout css="panier.css" titre="Panier  – DevGear">
    <x-nav />
    <main class="py-lg-5 cart-page container py-4">
        <section class="cart-shell">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end mb-4 gap-3">
                <div>
                    <h1 class="display-6 fw-bold mb-1">Votre panier</h1>
                    <a href="{{ route('figurines.index') }}">&larr; Retour à l'accueil</a>
                </div>
            </div>

            <div class="row g-4">
                <!-- Items -->
                <div class="col-lg-8">
                    <div class="glass rounded-4 p-lg-4 p-3">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('panier.modifier') }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="mb-0 table align-middle">
                                    <thead>
                                        <tr class="muted small">
                                            <th>Produit</th>
                                            <th style="width:140px;">Prix</th>
                                            <th style="width:180px;">Quantité</th>
                                            <th style="width:140px;">Total</th>
                                            <th style="width:60px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <img class="cart-thumb" src="{{ $item['produit']->image_Path }}"
                                                            alt="{{ $item['produit']->nom }}">
                                                        <div>
                                                            <div class="fw-semibold">{{ $item['produit']->nom }}</div>
                                                            <div class="muted small">
                                                                {{ $item['produit']->categorie->nom }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price">$ {{ $item['produit']->prix }}</td>
                                                <td>
                                                    <div class="input-group">
                                                        @error('quantites')
                                                            <p class="alert alert-warning">{{ $message }}</p>
                                                        @enderror

                                                        <input class="form-control text-center" type="number"
                                                            min="1" name="quantites[{{ $item['produit']->id }}]"
                                                            value="{{ $item['quantite'] }}" data-qty>

                                                    </div>
                                                </td>
                                                <td class="price fw-semibold" data-line-total>
                                                    ${{ $item['totalProduit'] }}
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('panier.supprimer', $item['produit']->id) }}"
                                                        class="btn btn-sm btn-outline-danger rounded-circle d-inline-flex align-items-center justify-content-center"
                                                        style="width: 2rem; height: 2rem;" title="Retirer"
                                                        aria-label="Retirer {{ $item['produit']->nom }} du panier">×</a>
                                                </td>

                                            </tr>

                                        @empty
                                            <!-- Message panier vide (à afficher conditionnellement) -->
                                            {{-- embeli par claude --}}
                                            <article class="cart-panel text-center py-5 px-3">
                                                <p class="small text-uppercase text-muted fw-semibold mb-2">Panier vide
                                                </p>
                                                <h2 class="h3 mb-2">Aucune figurine pour le moment</h2>
                                                <p class="text-muted mb-4">Explorez la collection et ajoutez vos
                                                    favoris.</p>
                                                <a href="{{ route('figurines.index') }}"
                                                    class="btn btn-primary px-4">Voir le catalogue</a>
                                            </article>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <hr class="my-4" style="border-color: rgba(255,255,255,.12);">

                            <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                                <div class="d-flex gap-2">
                                    <button type="submit" name="action" value="rafraichir"
                                        class="btn btn-outline-warning">Mettre a jour le panier</button>
                                    <button type="submit" name="action" value="vider"
                                        class="btn btn-outline-danger">Vider le panier</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sommaire -->
            <div class="col-lg-4">
                <div class="glass rounded-4 p-lg-4 p-3">
                    <h2 class="h5 fw-semibold mb-3">Commande</h2>

                    <div class="d-flex justify-content-between muted">
                        <span>Sous-total</span>
                        <span class="price" id="subtotal">$ {{ $sousTotal }}</span>
                    </div>
                    <div class="d-flex justify-content-between muted mt-2">
                        <span>Livraison</span>
                        <span class="price">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between muted mt-2">
                        <span>TPS</span>
                        <span class="price" id="tps">${{ $totalTPS }}</span>
                    </div>
                    <div class="d-flex justify-content-between muted mt-2">
                        <span>TVQ</span>
                        <span class="price" id="tvq">${{ $totalTVQ }}</span>
                    </div>

                    <hr class="my-3" style="border-color: rgba(255,255,255,.12);">

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Total</span>
                        <span class="price fs-4 fw-bold" id="total">${{ $total }}</span>
                    </div>

                    <div class="d-grid mt-4 gap-2">
                        <a href="{{ route('commande.confirmerPanier') }}" class="btn btn-accent btn-lg">Revue de la
                            commande</a>
                    </div>
                </div>
            </div>
            </div>
        </section>

    </main>

</x-layout>
