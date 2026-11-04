<x-layout>
    <x-nav />

    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 600px;">

            <div class="mb-4">
                <span class="catalog-tag">Profil</span>
                <h2 class="h3 fw-bold mb-1">Changer les informations du profil</h2>
                <a href="{{ route('figurines.index') }}"><- Accueil</a>
            </div>

            <article class="catalog-panel">
                <form action="{{ route('modifierProfil') }}" method="POST" class="row g-3">
                    @csrf

                    <x-auth.profilInput label="Nom" name="nom" type="text" />
                    <x-auth.profilInput label="Prénom" name="prenom" type="text" />
                    <x-auth.profilInput label="Adresse" name="adresse" type="text" />
                    <x-auth.profilInput label="Ville" name="ville" type="text" />
                    <x-auth.profilInput label="Code postal" name="codePostal" type="text" id="codePostal" />
                    <x-auth.profilInput label="Province" name="province" type="text" />
                    <x-auth.profilInput label="Téléphone" name="telephone" type="text" id="telephone" />

                    <div class="col-12 d-grid pt-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Modifier le profil
                        </button>
                    </div>

                </form>
            </article>

        </div>
    </section>




    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 600px;">

            <div class="mb-4">
                <span class="catalog-tag">Profil</span>
                <h2 class="h3 fw-bold mb-1">Changer le mot de passe</h2>
                <a href="{{ route('figurines.index') }}"><- Accueil</a>
            </div>

            <article class="catalog-panel">
                <form action="{{ route('modifierMotDePasse') }}" method="POST" class="row g-3">
                    @csrf

                    <div class="col-12">
                        <label class="form-label h6 text-uppercase small fw-semibold mb-1">
                            Mot de passe actuel
                        </label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label h6 text-uppercase small fw-semibold mb-1">
                            Nouveau mot de passe
                        </label>
                        <input type="password" name="new_password" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label h6 text-uppercase small fw-semibold mb-1">
                            Confirmer le nouveau mot de passe
                        </label>
                        <input type="password" name="new_password_confirmation" class="form-control form-control-lg"
                            required>
                    </div>

                    <div class="col-12 d-grid pt-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Modifier le mot de passe
                        </button>
                    </div>

                </form>
            </article>

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
