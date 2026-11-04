<x-layout>
    <x-nav />
    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width:1000pt;">
            <h2 class="h4 mb-3">Modifier la commande</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.modifierCommandePost') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $commande->id }}">

                <div>
                    Commande #{{ $commande->id }}
                </div>

                <div class="row g-2">
                    <div class="col-md-4 mb-3">
                        <div>{{ $client->nom }}</div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date de commande</label>
                        <span>{{ old('created_at', $commande->created_at) }}</span>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Etat</label>
                        <select name="etat" id="">
                            <option value="en_preparation">En préparation
                            </option>
                            <option value="envoye">Envoyée
                            </option>
                            <option value="en_transit">En
                                transit</option>
                            <option value="livree">Livrée
                            </option>
                        </select>
                    </div>
                </div>




                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix Unitaire</th>
                                {{-- <th>TPS (5%)</th>
                                <th>TVQ (9.975%)</th> --}}
                                <th>sousTotal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($achats as $achat)
                                <tr>
                                    <td>{{ $achat->nom_produit }}</td>

                                    <td>{{ $achat->quantite }}</td>

                                    <td>{{ number_format($achat->prix_unitaire / 100, 2, ',', ' ') }} $</td>

                                    <td>{{ number_format(($achat->quantite * $achat->prix_unitaire) / 100, 2, ',', ' ') }}
                                        $</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="3" class="text-end">TPS (5%)</td>
                                <td>{{ number_format($commande->tps / 100, 2, ',', ' ') }} $</td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-end">TVQ (9.975%)</td>
                                <td>{{ number_format($commande->tvq / 100, 2, ',', ' ') }} $</td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total</td>
                                <td class="fw-bold">{{ number_format($commande->montant_total / 100, 2, ',', ' ') }} $
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.adminCommandes') }}" class="btn btn-outline-secondary">Annuler</a>
        </div>
        </form>
        </div>
    </section>
</x-layout>
