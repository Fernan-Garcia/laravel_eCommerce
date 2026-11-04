<x-layout titre="Créer un compte">
    <x-nav />
    <x-header />

    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 600px;">

            <!-- Header -->
            <div class="mb-4 text-center">
                <span class="catalog-tag">Authentification</span>
                <h2 class="h3 fw-bold mb-1">Créer un compte</h2>
                <a href="{{ route('figurines.index') }}"><- Accueil</a>
            </div>

            <!-- Panel -->
            <div class="catalog-panel">
                <form method="POST" action="{{ route('inscription') }}" class="row g-3">
                    @csrf

                    <div class="col-md-6">
                        <x-auth.input label="Nom" name="nom" />
                    </div>

                    <div class="col-md-6">
                        <x-auth.input label="Prénom" name="prenom" />
                    </div>

                    <div class="col-12">
                        <x-auth.input label="Email" name="email" type="email" />
                    </div>

                    <div class="col-12">
                        <x-auth.input label="Adresse" name="adresse" />
                    </div>

                    <div class="col-md-6">
                        <x-auth.input label="Ville" name="ville" />
                    </div>

                    <div class="col-md-6">
                        <x-auth.input label="Code postal" name="codePostal" id="codePostal" />
                    </div>

                    <div class="col-12">
                        <x-auth.slideDown label="Province" name="province" />
                    </div>

                    <div class="col-12">
                        <x-auth.input label="Téléphone" name="telephone" id="telephone" />
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Erreur</strong> {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                        <label class="form-label small fw-semibold">Mot de passe</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                        <div class="form-text" style="color: var(--muted);">Minimum 8 caractères.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Confirmer le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control form-control-lg">
                    </div>

                    <div class="col-12 d-grid mt-2">
                        <button type="submit" class="btn btn-primary">
                            S'inscrire
                        </button>
                    </div>

                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4 small">
                <span class="text-muted">Déjà un compte ?</span>
                <a href="{{ route('connexionForm') }}">Se connecter</a>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            new Cleave('#telephone', {
                delimiters: ['-', '-'],
                blocks: [3, 3, 4],
                numericOnly: true
            });

            new Cleave('#codePostal', {
                blocks: [3, 3],
                delimiter: ' ',
                uppercase: true
            });

        });
    </script>
</x-layout>
