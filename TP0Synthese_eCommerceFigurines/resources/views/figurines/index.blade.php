<x-layout>
    {{-- navbar --}}
    <x-nav />
    {{-- header --}}
    <x-header />
    <section id="catalogue" class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mb-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
                <div>
                    <span class="catalog-tag">Collection figurines</span>
                    <h2 class="h3 fw-bold mb-1">Trouve ta prochaine figurine</h2>
                    <p class="text-muted mb-0">Filtre rapidement par recherche ou catégorie.</p>
                </div>
                <div class="catalog-counter">{{ $figurines->count() }} résultat{{ $figurines->count() > 1 ? 's' : '' }}</div>
            </div>

            <article class="catalog-panel mb-4">
            <form action="{{ route('figurines.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-lg-10">
                    <label class="form-label h6 text-uppercase small fw-semibold mb-1">Rechercher</label>
                    <input class="form-control form-control-lg" type="search" name="recherche"
                        placeholder="marvel, dc, frieren" value="{{ request()->recherche }}">
                </div>
                <div class="col-lg-2 d-grid">
                    <button type="submit" class="btn btn-primary">Appliquer</button>
                </div>
            </form>
            </article>

            <section id="categories" class="catalog-panel">
                <!-- copilot m'ai aide pour rendre la bare de recherche et les categories pllus presentables -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                    <h2 class="h5 mb-0">Catégories</h2>
                </div>

                <form action="{{ route('figurines.index') }}" method="GET" class="row g-3">

                    <div class="col-12 col-lg-9">
                        @forelse ($categories as $categorie)
                            <input
                                type="checkbox"
                                class="btn-check"
                                name="categories[]"
                                id="categorie{{ $categorie->id }}"
                                value="{{ $categorie->id }}"
                                autocomplete="off"
                                @checked($filtres->contains($categorie->id))>
                            <label for="categorie{{ $categorie->id }}" class="btn btn-outline-accent">
                                {{ $categorie->nom }}
                            </label>
                        @empty
                            <p>Aucune catégorie disponible</p>
                        @endforelse

                    </div>

                    <div class="col-12 col-lg-3 d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                        <a href="{{ route('figurines.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                    </div>


                </form>
            </section>
        </div>

        <section class="catalog-grid-wrap py-2 py-lg-3">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse ($figurines as $figurine)
                    <x-figurine.card :figurine="$figurine" />
                @empty
                    <div class="col-12 col-sm-8 col-lg-6">
                        <div class="catalog-panel text-center py-5 px-3">
                            <p class="small text-uppercase text-muted fw-semibold mb-2">Aucun résultat</p>
                            <h3 class="h4 mb-2">Aucune figurine à afficher</h3>
                            <p class="text-muted mb-0">Essaie d'enlever un filtre ou de modifier ta recherche.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </section>

    <x-modale />
</x-layout>
