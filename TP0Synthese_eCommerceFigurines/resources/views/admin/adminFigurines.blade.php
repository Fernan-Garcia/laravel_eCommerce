<x-layout>
    <x-nav />

    <section class="catalog-page container py-4 py-lg-5">
        <div class="catalog-shell mx-auto" style="max-width: 900px;">
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
                <h2 class="h3 fw-bold mb-1">Figurines</h2>
                <p class="text-muted small mb-2">
                    Modifier les figurines existantes.
                </p>

                <a href="{{ route('figurines.index') }}"
                    class="d-inline-flex align-items-center gap-1 small text-decoration-none" style="color:#6c757d;">
                    ← Accueil
                </a>

                <a href="{{ route('admin.ajouterFigurine') }}" class="btn btn-success btn-sm">
                    Ajouter une figurine
                </a>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($figurines as $figurine)
                            <tr>
                                <td>#{{ $figurine->id }}</td>

                                <td>{{ $figurine->nom }}</td>

                                <td>{{ $figurine->prix }} $</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.modifierFigurines', $figurine->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Modifier
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>

</x-layout>
