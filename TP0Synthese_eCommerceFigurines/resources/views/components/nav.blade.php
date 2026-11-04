<!-- Navigation -->
<nav class="navbar navbar-expand-lg sticky-top border-bottom bg-white shadow-sm py-3">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand fw-bold fs-4" href="{{ route('figurines.index') }}">
            <span class="catalog-tag me-2">Figurine Shop</span>

        </a>

        {{-- Mobile button --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Nav content --}}
        <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarSupportedContent">

            {{-- Left side --}}
            <ul class="navbar-nav me-auto mb-3 mb-lg-0 ms-lg-4 align-items-lg-center gap-lg-2">

                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->routeIs('figurines.index') ? 'active' : '' }}"
                        href="{{ route('figurines.index') }}">
                        Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->routeIs('contact.index') ? 'active' : '' }}"
                        href="{{ route('contact.index') }}">
                        Contact
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Magasin
                    </a>

                    <ul class="dropdown-menu shadow border-0 rounded-4 mt-2">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('figurines.index') }}">
                                Tous les produits
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="{{ route('figurines.index') }}">
                                Produits populaires
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item py-2" href="{{ route('figurines.index') }}">
                                Nouveautés
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

            {{-- Right side --}}
            <div class="d-flex flex-column flex-lg-row gap-2 align-items-lg-center">
                @auth('client')
                    <a href="{{ route('commande.historique') }}" class="btn btn-outline-accent">
                        Mes commandes
                    </a>

                    <a href="{{ route('profilForm') }}" class="btn btn-outline-accent">
                        Profil
                    </a>

                    @if (auth('client')->user()->is_admin)
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Administration
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.adminCategories') }}">Categories</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.adminFigurines') }}">Figurines</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.adminCommandes') }}">Commandes</a></li>
                            </ul>
                        </div>
                    @endif


                    <form method="POST" action="{{ route('deconnexion') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary w-100">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('connexionForm') }}" class="btn btn-outline-accent">
                        Connexion
                    </a>

                    <a href="{{ route('inscriptionForm') }}" class="btn btn-primary">
                        Inscription
                    </a>
                @endauth

                {{-- Cart --}}
                <form action="{{ route('panier.index') }}">
                    <button class="btn btn-dark position-relative px-4" type="submit">
                        Panier

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ session('panier') ? count(session('panier')) : 0 }}
                        </span>
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>
