<x-layout titre="DevGear - Paiement">

    <x-nav />
    <x-header />

    <section class="catalog-page container py-4 py-lg-5">

        {{-- Header --}}
        <div class="catalog-shell mb-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
                <div>
                    <span class="catalog-tag">Paiement sécurisé</span>
                    <h2 class="h3 fw-bold mb-1">Finaliser votre commande</h2>
                    <p class="text-muted mb-0">
                        Vérifiez votre panier et complétez votre paiement en toute sécurité.
                    </p>
                </div>

                <div class="catalog-counter">
                    {{ count($items) }} article{{ count($items) > 1 ? 's' : '' }}
                </div>
            </div>
        </div>

        <div class="row g-4">

            {{-- Formulaire paiement --}}
            <div class="col-lg-7">
                <article class="catalog-shell h-100">
                    <div class="mb-4">
                        <h3 class="h5 fw-bold mb-1">Informations de paiement</h3>
                        <p class="text-muted mb-0 small">
                            Paiement traité via Stripe.
                        </p>
                    </div>

                    <form id="payment-form" method="POST">

                        <div class="mb-4">
                            <label class="form-label h6 text-uppercase small fw-semibold mb-2">
                                Numéro de carte
                            </label>

                            <div id="card-element" class="form-control form-control-lg py-3"></div>

                            <div id="card-errors" class="text-danger small mt-2"></div>
                        </div>

                        <button id="submit-btn" type="submit" class="btn btn-primary w-100 btn-lg">
                            Payer {{ number_format($total, 2, ',') }} $
                        </button>
                    </form>
                </article>
            </div>

            {{-- Résumé --}}
            <div class="col-lg-5">
                <article class="catalog-shell h-100">

                    <div class="mb-4">
                        <h3 class="h5 fw-bold mb-1">Récapitulatif</h3>
                        <p class="text-muted mb-0 small">
                            Vérifiez les détails avant de confirmer.
                        </p>
                    </div>

                    @foreach ($items as $item)
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <div class="fw-semibold">
                                    {{ $item['produit']->nom }}
                                </div>

                                <small class="text-muted">
                                    Quantité : {{ $item['quantite'] }}
                                </small>
                            </div>

                            <span class="fw-semibold">
                                ${{ number_format($item['totalProduit'], 2, ',') }}
                            </span>
                        </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Sous-total</span>
                        <span>${{ number_format($sousTotal, 2, ',') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">TPS (5%)</span>
                        <span>${{ number_format($totalTPS, 2, ',') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">TVQ (9,975%)</span>
                        <span>${{ number_format($totalTVQ, 2, ',') }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-4">
                            {{ number_format($total, 2, ',') }} $
                        </span>
                    </div>

                    <a href="{{ route('panier.index') }}" class="btn btn-outline-secondary w-100">
                        ← Retour au panier
                    </a>

                </article>
            </div>

        </div>
    </section>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe('{{ $stripeKey }}')
            const elements = stripe.elements()

            const cardElement = elements.create('card', {
                style: {
                    base: {
                        color: '#212529',
                        fontSize: '16px',
                        fontFamily: 'system-ui, sans-serif',
                        '::placeholder': {
                            color: '#6c757d'
                        }
                    },
                    invalid: {
                        color: '#dc3545'
                    }
                },
                hidePostalCode: true
            })

            cardElement.mount('#card-element')

            cardElement.on('change', function(event) {
                document.querySelector('#card-errors').textContent =
                    event.error ? event.error.message : ''
            })

            document.querySelector("#payment-form").addEventListener("submit", function(event) {
                event.preventDefault()

                const submitBtn = document.querySelector("#submit-btn")
                submitBtn.disabled = true
                submitBtn.textContent = "Traitement..."

                axios.post('{{ route('commande.payer') }}')
                    .then(function(response) {
                        return stripe.confirmCardPayment(response.data.clientSecret, {
                            payment_method: {
                                card: cardElement
                            }
                        })
                    })
                    .then(function(resultat) {
                        if (resultat.error) {
                            gererErreur(resultat.error)
                        } else if (resultat.paymentIntent.status === 'succeeded') {
                            gererSucces(resultat.paymentIntent)
                        }
                    })
                    .catch(function(erreur) {
                        const message = erreur.response ?
                            erreur.response.data.error :
                            'Impossible de joindre le serveur.'

                        gererErreur({
                            message: message
                        })
                    })
            })

            function gererSucces(paymentIntent) {
                window.location.href =
                    '{{ route('commande.confirmation') }}?payment_intent=' +
                    paymentIntent.id
            }

            function gererErreur(erreur) {
                document.querySelector("#card-errors").textContent = erreur.message

                const submitBtn = document.querySelector("#submit-btn")
                submitBtn.disabled = false
                submitBtn.textContent =
                    'Payer {{ number_format($total, 2, ',') }} $'
            }
        </script>
    @endpush

</x-layout>
