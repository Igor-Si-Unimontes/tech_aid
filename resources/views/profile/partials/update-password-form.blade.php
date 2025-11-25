<section>
    <header class="mb-4">
        <h2 class="h5">
            {{ __('Atualizar Senha') }}
        </h2>

        <p class="text-muted small">
            {{ __('Certifique-se de que sua conta está usando uma senha longa e aleatória para manter a segurança.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">
                {{ __('Senha Atual') }}
            </label>
            <input 
                type="password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                id="update_password_current_password"
                name="current_password"
                autocomplete="current-password"
            >
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">
                {{ __('Nova Senha') }}
            </label>
            <input 
                type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                id="update_password_password"
                name="password"
                autocomplete="new-password"
            >
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">
                {{ __('Confirmar Senha') }}
            </label>
            <input 
                type="password"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                id="update_password_password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
            >
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Salvar') }}
            </button>

            @if (session('status') === 'password-updated')
                <span 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small"
                >
                    {{ __('Salvo.') }}
                </span>
            @endif
        </div>
    </form>
</section>
