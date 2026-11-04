<x-layout>
    <x-nav />
    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width:700px;">
            <h2 class="h4 mb-3">Modifier la figurine</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.modifierFigurinesPost') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $figurine->id }}">
                <x-admin.modifInput name="nom" type="text" label="Nom" :figurine="$figurine" class="mb-3" />
                <x-admin.modifInput name="description" type="text" label="Description" :figurine="$figurine"
                    class="mb-3" />

                <div class="row">
                    <x-admin.modifInput name="prix" type="number" label="Prix" :figurine="$figurine"
                        class="col-md-4 mb-3" />
                    <x-admin.modifInput name="stock" type="number" label="Stock" :figurine="$figurine"
                        class="col-md-4 mb-3" />

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Catégorie</label>
                        <select name="categorie_id" class="form-select">
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">
                                    {{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL de l'image</label>
                    <input type="file" name="image_Path" class="form-control" accept="image/*">
                    @error('image_Path')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('admin.adminFigurines') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </section>
</x-layout>
