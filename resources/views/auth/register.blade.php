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

                <h2 class="fw-bold mb-3">Registre-se</h2>
                <p class="text-muted mb-4">Por favor, preencha suas informações abaixo</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input class="form-control" type="text" name="name" required value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Número de celular</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input class="form-control" type="text" name="phone" id="phone">
                            @error('phone')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="mb-3">
                        <label class="form-label">Endereço</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input class="form-control" type="text" name="address" id="address">
                            @error('address')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input class="form-control" type="email" name="email" required>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input class="form-control" type="password" name="password" required>
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirme a Senha</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-100 py-2">
                        Próximo <i class="fas fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center mt-4">
                        Já tem uma conta?  
                        <a href="{{ route('login') }}" class="fw-bold">Faça login na sua conta</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
</x-guest-layout>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.getElementById("phone");

    phoneInput.addEventListener("input", function () {
        let value = this.value.replace(/\D/g, ""); // remove tudo que não é número

        if (value.length > 11) value = value.substring(0, 11);

        if (value.length <= 10) {
            // máscara para números fixos e celulares antigos
            this.value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, "($1) $2-$3");
        } else {
            // máscara para celular atual (11 dígitos)
            this.value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3");
        }
    });
});
</script>
