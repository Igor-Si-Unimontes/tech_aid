<x-guest-layout>
<div class="container-fluid p-0">
    <div class="row g-0">
        
        <!-- LADO ESQUERDO -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-between text-white" 
             style="background-image: url('login.png'); background-size: cover; background-position: center; padding: 40px;">
            
            <div class="d-flex align-items-center">
            </div>

            <div class="text-center">
                <h1 class="fw-bold display-5">TECH AID</h1>
            </div>

            <div class="d-flex justify-content-center gap-3 pb-4">
                
            </div>
        </div>

        <!-- LADO DIREITO -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white p-5" style="min-height: 100vh;">
            <div style="max-width: 400px; width: 100%;">

                <h2 class="fw-bold mb-3">Login</h2>
                <p class="text-muted mb-4">Entre com suas credenciais</p>

                <!-- Status da sessão -->
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror"
                                required
                            >
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Lembrar-me -->
                    <div class="mb-4 form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                        >
                        <label class="form-check-label" for="remember">
                            Lembrar-me
                        </label>
                    </div>

                    <!-- Botão Entrar -->
                    <button class="btn btn-primary w-100 py-2">
                        Entrar <i class="fas fa-sign-in-alt ms-2"></i>
                    </button>

                    <!-- Link para registro -->
                    <div class="text-center mt-4">
                        Ainda não tem conta?
                        <a href="{{ route('register') }}" class="fw-bold">Criar conta</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
</x-guest-layout>
