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
            <h1 class="mb-0 text-black fw-bold">Sistema de Chamados</h1>
            <p class="text-muted">Gerencie seus chamados de forma eficiente</p>
        </div>
        <div class="col-6 text-end d-flex justify-content-end align-items-start">
            @can('create chamado')
            <a href="{{ route('chamados.create') }}" class="btn btn-primary me-2">
                Novo Chamado <i class="fa fa-plus"></i>
            </a>
            @endcan

            @if(Route::currentRouteName() === 'chamados.index')
                <a href="{{ route('chamados.closed') }}" class="btn btn-secondary">
                    Ver Chamados Fechados <i class="fa fa-eye"></i>
                </a>
            @elseif(Route::currentRouteName() === 'chamados.closed')
                <a href="{{ route('chamados.index') }}" class="btn btn-success">
                    Ver Chamados Ativos <i class="fa fa-eye"></i>
                </a>
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            @if($chamados->isEmpty())
                <div class="alert alert-info">
                    Nenhum chamado encontrado.
                </div>
            @endif
            @if($chamados->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Status</th>
                            <th>Prioridade</th>
                            <th>Abertura</th>
                            <th>Iniciado o atendimento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    @foreach ($chamados as $chamado)
                    <tbody>
                        <tr>
                            <td>{{ $chamado->id }}</td>
                            <td>{{ $chamado->title }}</td>
                            <td>{{ $chamado->status->label() }}</td>
                            <td>{{ $chamado->priority->label() }}</td>
                            <td> {{ \Carbon\Carbon::parse($chamado->opening)->format('d/m/Y H:i') }}</td>
                            @if($chamado->in_progress)
                            <td> Iniciado em : {{ \Carbon\Carbon::parse($chamado->in_progress)->format('d/m/Y H:i') }} por {{ $chamado->responsavel->name }}</td>
                            @else
                            <td> - </td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#viewModal{{ $chamado->id }}" title="Visualizar chamado">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <a href="{{ route('chamados.edit', $chamado->id) }}" class="btn btn-sm btn-warning" title="Editar chamado"><i class="fa fa-edit"></i></a>
                                
                                @if(Route::currentRouteName() === 'chamados.index')
                                @can('close chamado')
                                @if($chamado->status === \App\Enum\Status::andamento)
                                <a href="{{ route('chamados.close', $chamado->id) }}" class="btn btn-sm btn-success" title="Fechar chamado"><i class="fa fa-close"></i></a>
                                @elseif($chamado->status === \App\Enum\Status::aberto)
                                <a href="{{ route('chamados.open', $chamado->id) }}" class="btn btn-sm btn-success" title="Iniciar chamado"><i class="fa fa-play"></i></a>
                                @endif
                                @endcan
                                <a href="{{ route('chamados.mensagens', $chamado->id) }}" class="btn btn-sm btn-info" title="Mensagem"><i class="fa fa-message"></i></a>
                                @elseif(Route::currentRouteName() === 'chamados.closed')
                                <a href="{{ route('chamados.mensagens', $chamado->id) }}" class="btn btn-sm btn-info" title="Mensagem"><i class="fa fa-message"></i></a>
                                @php
    $feedbackJaEnviado = \App\Models\Feedbacks::where('chamado_id', $chamado->id)
        ->where('user_id', auth()->id())
        ->exists();
@endphp

@if($chamado->status === \App\Enum\Status::fechado && !$feedbackJaEnviado)
    <button type="button"
            class="btn btn-sm btn-success"
            data-bs-toggle="modal"
            data-bs-target="#feedbackModal{{ $chamado->id }}">
        <i class="fa fa-star"></i>
    </button>
@endif

                                @endif
                                <!-- Modal de exclusao -->
                                <div class="modal fade" id="deleteModal{{ $chamado->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $chamado->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $chamado->id }}">Confirmar
                                                    Exclusão</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Fechar"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir o chamado
                                                <strong>{{ $chamado->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('chamados.destroy', $chamado->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal de visualização -->
                                <div class="modal fade" id="viewModal{{ $chamado->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $chamado->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> <!-- modal maior -->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel{{ $chamado->id }}">Detalhes do Chamado #{{ $chamado->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                        <dt class="col-sm-3">Título:</dt>
                                        <dd class="col-sm-9">{{ $chamado->title }}</dd>

                                        <dt class="col-sm-3">Descrição:</dt>
                                        <dd class="col-sm-9">{{ $chamado->description }}</dd>

                                        <dt class="col-sm-3">Status:</dt>
                                        <dd class="col-sm-9">{{ $chamado->status->label() }}</dd>

                                        <dt class="col-sm-3">Prioridade:</dt>
                                        <dd class="col-sm-9">{{ $chamado->priority->label() }}</dd>

                                        <dt class="col-sm-3">Aberto em:</dt>
                                        <dd class="col-sm-9">{{ $chamado->opening->format('d/m/Y H:i') }}</dd>

                                        <dt class="col-sm-3">Fechado em:</dt>
                                        <dd class="col-sm-9">{{ $chamado->closing ? $chamado->closing->format('d/m/Y H:i') : '-' }}</dd>

                                        <dt class="col-sm-3">Responsável:</dt>
                                        <dd class="col-sm-9">{{ $chamado->user->name }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
<!-- Modal de Feedback -->
<div class="modal fade" id="feedbackModal{{ $chamado->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel{{ $chamado->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('feedbacks.store') }}" method="POST">
                @csrf

                <input type="hidden" name="chamado_id" value="{{ $chamado->id }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel{{ $chamado->id }}">
                        Avaliar Chamado #{{ $chamado->id }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">

                    <!-- Estrelas -->
                    <div class="mb-3 text-center">
                        <style>
                            .star-rating i {
                                font-size: 28px;
                                cursor: pointer;
                                color: #ccc;
                            }
                            .star-rating .selected {
                                color: #f1c40f !important;
                            }
                        </style>

                        <div class="star-rating d-flex justify-content-center">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star" data-value="{{ $i }}"></i>
                            @endfor
                        </div>

                        <input type="hidden" name="rating" id="ratingInput{{ $chamado->id }}">
                    </div>

                    <!-- Comentário -->
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comentário</label>
                        <textarea name="comments" class="form-control" rows="3" required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar Avaliação</button>
                </div>

            </form>
        </div>
    </div>
</div>


                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".star-rating").forEach(function (ratingBox) {

        const modalId = ratingBox.closest(".modal").id.replace("feedbackModal", "");
        const input = document.getElementById("ratingInput" + modalId);

        ratingBox.querySelectorAll("i").forEach(function (star) {

            star.addEventListener("click", function () {

                let rating = this.getAttribute("data-value");
                input.value = rating;

                ratingBox.querySelectorAll("i").forEach(function (s) {
                    s.classList.remove("selected");
                });

                for (let i = 0; i < rating; i++) {
                    ratingBox.querySelectorAll("i")[i].classList.add("selected");
                }

            });
        });
    });
});
</script>

@endsection
