<x-layout>
    <x-nav />
    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 640px;">
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
                <h2 class="h3 fw-bold mb-1">Catégories</h2>
                <p class="text-muted small mb-2">Modifier le nom des catégories existantes.</p>
                <a href="{{ route('figurines.index') }}"
                    class="d-inline-flex align-items-center gap-1 small text-decoration-none" style="color:#6c757d;">
                    ← Accueil
                </a>
            </div>

            @foreach ($categories as $categorie)
                <article class="catalog-panel mb-3">
                    <form action="{{ route('admin.modifierCategories') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $categorie->id }}">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="catalog-counter">#{{ $categorie->id }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-semibold">
                                Nom de la catégorie
                            </label>
                            <input class="form-control" type="text" id="nom-{{ $categorie->id }}" name="nom"
                                value="{{ $categorie->nom }}" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Modifier
                            </button>
                        </div>

                    </form>
                </article>
            @endforeach

        </div>
    </section>

    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 600px;">

            <div class="mb-4">
                <span class="catalog-tag">Categorie</span>
                <h2 class="h3 fw-bold mb-1">Ajouter une catégorie</h2>
                <a href="{{ route('figurines.index') }}"><- Accueil</a>
            </div>

            <article class="catalog-panel">
                <form action="{{ route('admin.ajouterCategorie') }}" method="POST" class="row g-3">
                    @csrf

                    <div class="col-12">
                        <label class="form-label h6 text-uppercase small fw-semibold mb-1">
                            Nom de la catégorie
                        </label>
                        <input type="text" name="nom" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-12 d-grid pt-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Ajouter la catégorie
                        </button>
                    </div>

                </form>
            </article>

        </div>
    </section>
</x-layout>
