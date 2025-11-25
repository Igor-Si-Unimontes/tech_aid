<x-app-layout>
    
    <div class="container py-5">

        <!-- TÍTULO -->
        <div class="mb-4">
            <h1 class="fw-bold text-dark">Dashboard</h1>
            <p class="text-muted">Bem-vindo ao sistema, {{ Auth::user()->name }} 👋</p>
        </div>

        <div class="row g-4">

            <!-- CARD 1 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Status</h5>
                        <p class="text-muted mb-3">Você está conectado ao sistema.</p>
                        <span class="badge bg-success px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> Online
                        </span>
                    </div>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Minha Conta</h5>
                        <p class="text-muted mb-3">Gerencie seus dados e configurações.</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100">
                            <i class="fas fa-user me-2"></i> Editar Perfil
                        </a>
                    </div>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Sair</h5>
                        <p class="text-muted mb-3">Encerrar sua sessão com segurança.</p>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- BLOCO DE MENSAGEM DO SISTEMA -->
        <div class="mt-5">
            <div class="alert alert-primary d-flex align-items-center gap-3 shadow-sm" role="alert">
                <i class="fas fa-bullhorn fa-lg"></i>
                <div>
                    Você está logado e pronto para usar o sistema!
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
