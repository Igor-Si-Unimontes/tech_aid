@extends('layouts.app')

@section('content')
    <!-- Mensagens de sessão -->
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
    <div class="row mb-4">

        <div class="col-6">
            <h1 class="mb-0 text-black fw-bold">Mensagens do Chamado #{{ $chamado->id }}</h1>
            <p class="text-muted">Título: {{ $chamado->title }}</p>
        </div>
        <div class="col-6 text-end d-flex justify-content-end align-items-start">
            <a href="{{ route('chamados.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i>
                Voltar para Chamados 
            </a>
        </div>

    </div>

<div class="row">
    <div class="col-12">
        @if($mensagens->isEmpty())
            <div class="alert alert-info">
                Nenhuma mensagem encontrada para este chamado.
            </div>
        @else
            @foreach ($mensagens as $mensagem)
                @php
                    $isMine = $mensagem->user_id === auth()->id();
                @endphp

                <div class="d-flex mb-3 {{ $isMine ? 'justify-content-end' : 'justify-content-start' }}">
                    <div class="card p-0 shadow-sm"
                        style="
                            max-width: 70%;
                            background: {{ $isMine ? '#e6e6e6' : '#ffffff' }};
                            border-radius: 15px;
                        ">
                        <div class="card-header py-2 px-3"
                            style="border-top-left-radius:15px;border-top-right-radius:15px;">
                            <small class="text-muted">
                                {{ $mensagem->user->name }}
                                — {{ $mensagem->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>

                        <div class="card-body py-2 px-3">
                            <p class="mb-0">{{ $mensagem->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

        <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Enviar nova mensagem</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('mensagens.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="chamado_id" value="{{ $chamado->id }}">

                        <div class="mb-3">
                            <label for="content" class="form-label">Mensagem</label>
                            <textarea class="form-control" name="content" id="content" rows="4" required
                                placeholder="Digite sua mensagem aqui..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Enviar Mensagem <i class="fa fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
