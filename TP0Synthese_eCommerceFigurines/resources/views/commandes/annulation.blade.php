{{-- ========================= --}}
{{-- PAGE : Paiement annulé --}}
{{-- ========================= --}}
<x-layout titre="DevGear - Paiement annulé">

    <x-nav />
    <x-header />

    <section class="catalog-page container py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">

                <article class="catalog-panel text-center py-5 px-4">

                    <div class="mb-4 fs-1">❌</div>

                    <span class="catalog-tag">Paiement</span>
                    <h2 class="h3 fw-bold mt-2 mb-3">Paiement non complété</h2>

                    <p class="text-muted mb-4">
                        Votre paiement n'a pas été effectué.
                        Aucun montant n'a été débité de votre carte.
                    </p>

                    <div class="d-grid gap-3">
                        <a href="{{ route('checkout') }}" class="btn btn-primary">
                            Réessayer
                        </a>

                        <a href="{{ route('panier.index') }}" class="btn btn-outline-secondary">
                            Retour au panier
                        </a>
                    </div>

                </article>

            </div>
        </div>
    </section>

</x-layout>
