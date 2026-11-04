@props(['figurine'])
<div class="col mb-5">
    <div class="card h-100 catalog-card border-0 cart-shell">
        <!-- Product image-->
        @if ($figurine->image_Path)
            <img class="card-img-top" src="{{ asset($figurine->image_Path) }}" alt="{{ $figurine->nom }}" />
        @else
            <img class="card-img-top" src="{{ asset('images/no-image-available.jpg') }}" alt="Image par défaut" />
        @endif
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center mb-2">
                <!-- Product name-->
                <h5 class="fw-bolder">{{ $figurine->nom }}</h5>
                <!-- Product price-->
                <span class="catalog-price">{{ number_format($figurine->prix, 2) }} $</span>
            </div>
            <div class="text-center">
                @if ($figurine->stock == 0)
                    <span class="catalog-stock text-danger">Rupture de stock</span>
                @else
                    <span class="catalog-stock">Stock: {{ $figurine->stock }}</span>
                @endif
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-grid gap-2">
            <div class="text-center">
                <a class="btn btn-outline-secondary btn-details mt-auto w-100"
                    href="{{ route('figurines.show', $figurine->id) }}" data-bs-toggle="modal"
                    data-bs-target="#figurineModal">
                    Voir le produit
                </a>
            </div>
            <form action="{{ route('panier.ajouter', $figurine->id) }}" method="POST">
                {{-- ccsrf pour protection obligatoire dans un formulaire POST --}}
                @csrf
                <input type="hidden" name="id" value="{{ $figurine->id }}">
                <input class="btn btn-primary w-100" type="submit" name="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
</div>
