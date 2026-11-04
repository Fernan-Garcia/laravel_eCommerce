<x-layout>
    <x-nav />
    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto "style="max-width: 900px;">
            <h1>Ajouter une figurine</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.ajouterFigurinePost') }}" method="POST" enctype="multipart/form-data"
                class="mt-4 catalogue-shell">
                @csrf

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description"
                        class="form-control">{{ old('description') }}</input>
                </div>

                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" step="0.01" name="prix" id="prix" class="form-control"
                        value="{{ old('prix') }}" required>
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control"
                        value="{{ old('stock', 0) }}" required>
                </div>

                <div class="form-group">
                    <label for="categorie_id">Catégorie</label>
                    <select name="categorie_id" id="categorie_id" class="form-control" required>
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}"
                                {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image_Path">URL de l'image</label>
                    <input type="file" name="image_Path" id="image_Path" class="form-control" accept="image/*">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="{{ route('admin.adminFigurines') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </section>
</x-layout>
