<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $figurine->nom }}</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="d-flex gap-3">
        <img class="thumb" src="{{ asset($figurine->image_Path) }}" alt="{{ $figurine->nom }}" style="width: 220px;">
        <div>
            <p class="muted small mb-3">
                {{ $figurine->description }}
            </p>
            <p>
                Categorie: {{ $figurine->categorie->nom }}
            </p>
            <p>
                Stock: {{ $figurine->stock }}
            </p>
            <div class="price fw-semibold fs-4 mb-3">{{ $figurine->prix }} $</div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-accent ms-2" data-bs-dismiss="modal">Continuer</button>
    <button type="button" class="btn btn-accent">Ajouter au panier</button>
</div>
