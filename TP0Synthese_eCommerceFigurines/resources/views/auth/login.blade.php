<x-layout titre="Connexion">
    <x-nav />
    <x-header />

    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 500px;">

            <!-- Header -->
            <div class="mb-4 text-center">
                <span class="catalog-tag">Authentification</span>
                <h2 class="h3 fw-bold mb-1">Connexion</h2>
                <a href="{{ route('figurines.index') }}"><- Accueil</a>
            </div>

            <!-- Panel -->
            <div class="catalog-panel">
                <form action="{{ route('connexion') }}" method="POST" class="row g-3">
                    @csrf

                    <x-auth.input label="Adresse courriel" name="email" type="email" id="email" />

                    <x-auth.input label="Mot de passe" name="password" type="password" id="password" />

                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-primary">
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4 small">
                <span class="text-muted">Pas encore de compte ?</span>
                <a href="{{ route('inscriptionForm') }}">Créer un compte</a>
            </div>

        </div>
    </section>
</x-layout>
