{{-- ========================= --}}
{{-- PAGE : Confirmation --}}
{{-- ========================= --}}
<x-layout titre="DevGear - Commande confirmée">

    <x-nav />
    <x-header />

    <section class="catalog-page container py-4 py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">

                <article class="catalog-panel text-center py-5 px-4">

                    <div class="mb-4 fs-1">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>

                    <span class="catalog-tag">Commande confirmée</span>
                    <h2 class="h3 fw-bold mt-2 mb-3">Paiement réussi !</h2>

                    <p class="text-muted mb-4">
                        Merci pour votre commande.
                        Votre paiement a été traité avec succès.
                    </p>

                    <a href="{{ route('figurines.index') }}" class="btn btn-primary btn-lg w-100">
                        Continuer mes achats
                    </a>

                </article>

            </div>
        </div>
    </section>

</x-layout>
