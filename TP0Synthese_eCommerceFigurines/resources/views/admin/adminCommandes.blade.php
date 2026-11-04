<x-layout>
    <x-nav />

    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 900px;">
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

            <div class="mb-4">
                <span class="catalog-tag">Administration</span>
                <h2 class="h3 fw-bold mb-1">Commandes</h2>
                <p class="text-muted small mb-2">
                    Modifier les commandes existantes.
                </p>

                <a href="{{ route('figurines.index') }}"
                    class="d-inline-flex align-items-center gap-1 small text-decoration-none" style="color:#6c757d;">
                    ← Accueil
                </a>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th class="text-center">État</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($commandes as $commande)
                            <tr>
                                <td>#{{ $commande->id }}</td>

                                <td>{{ $commande->client->nom }}</td>

                                <td>{{ $commande->created_at->format('d/m/Y') }}</td>

                                <td>{{ number_format($commande->montant_total / 100, 2) }} $</td>

                                <td class="text-center">
                                    <span> {{ $commande->achats->first()->etat }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.modifierCommande', $commande->id) }}"
                                        class="btn btn-primary btn-sm">
                                        Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Aucune commande trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </section>

</x-layout>
