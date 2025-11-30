@extends('layouts.app')

@section('content')

    {{-- ALERTAS --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif


    <!-- TÍTULO + BOTÃO -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="fw-bold text-black">Dashboard do Sistema</h1>
            <p class="text-muted">Visão geral dos chamados e ações rápidas</p>
        </div>
    </div>


    <!-- CARDS ESTATÍSTICOS -->
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Chamados Abertos</h6>
                    <h2 class="fw-bold text-primary">{{ $chamadosAbertos }}</h2>
                    <p class="small text-muted mb-0"><i class="fas fa-clock me-1"></i> Aguardando atendimento</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Em Andamento</h6>
                    <h2 class="fw-bold text-warning">{{ $chamadosEmAndamento }}</h2>
                    <p class="small text-muted mb-0"><i class="fas fa-spinner me-1"></i> Sendo tratados</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Concluídos</h6>
                    <h2 class="fw-bold text-success">{{ $chamadosFechados }}</h2>
                    <p class="small text-muted mb-0"><i class="fas fa-check-circle me-1"></i> Resolvidos este mês</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Geral</h6>
                    <h2 class="fw-bold text-dark">{{ $totalChamados }}</h2>
                    <p class="small text-muted mb-0"><i class="fas fa-list me-1"></i> Todos os chamados</p>
                </div>
            </div>
        </div>

    </div>


    <!-- LISTA DE ÚLTIMOS CHAMADOS -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0 pb-0">
            <h5 class="fw-bold mb-0">Últimos Chamados</h5>
            <p class="text-muted small">Chamados recentes criados pelos usuários</p>
        </div>

        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Prioridade</th>
                        <th>Data</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($ultimosChamados as $chamado)
                    <tr>
                        <td>#{{ $chamado->id }}</td>
                        <td>{{ $chamado->title }}</td>
                        <td>
                            @if($chamado->status->value === 'aberto')
                                <span class="badge bg-success ms-2">Aberto</span>
                            @elseif($chamado->status->value === 'andamento')
                                <span class="badge bg-warning text-dark ms-2">Em Andamento</span>
                            @elseif($chamado->status->value === 'fechado')
                                <span class="badge bg-danger ms-2">Fechado</span>
                            @endif

                        </td>
                        <td>
                            @if($chamado->priority->value === 'alta')
                                <span class="badge bg-danger">Alta</span>

                            @elseif($chamado->priority->value === 'media')
                                <span class="badge bg-warning text-dark">Média</span>

                            @elseif($chamado->priority->value === 'baixa')
                                <span class="badge bg-success text-white">Baixa</span>
                            @endif
                        </td>

                        <td>{{ $chamado->created_at->format('d/m/Y H:i') }}</td>
                    </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

@endsection
