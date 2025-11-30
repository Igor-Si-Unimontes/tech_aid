<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <span class="fw-bold">TECH AID</span>
        </a>

        <!-- Botão Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarMain">

    <!-- MENU CENTRAL -->
    <ul class="navbar-nav mx-auto">

        <!-- Chamados -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is('chamados*') ? 'active fw-bold' : '' }}"
               href="#" id="menuChamados" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-ticket-alt me-1"></i> Chamados
            </a>

            <ul class="dropdown-menu" aria-labelledby="menuChamados">
                <li><a class="dropdown-item" href="{{ route('chamados.index') }}">Listar Chamados</a></li>
            </ul>
        </li>

        <!-- Artigos -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is('artigos*') ? 'active fw-bold' : '' }}"
               href="#" id="menuArtigos" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-users me-1"></i> Artigos
            </a>

            <ul class="dropdown-menu" aria-labelledby="menuArtigos">
                <li><a class="dropdown-item" href="{{ route('artigos.index') }}">Listar Artigos</a></li>
            </ul>
        </li>
    </ul>

    <!-- Usuário (lado direito) -->
    <ul class="navbar-nav ms-auto">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-semibold" href="#" id="userDropdown"
               role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>
                {{ Auth::user()->name }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user-edit me-2"></i> Perfil
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Sair
                        </button>
                    </form>
                </li>

            </ul>
        </li>

    </ul>

</div>

    </div>
</nav>
