@extends('layouts.app')

@section('title', 'Lista de Pessoas')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-people-fill"></i> Listar
                </h5>
            </div>
            <div class="card-body">
                <!-- Tabela de Individuals -->
                <table id="individualsTable" class="table table-hover table-striped w-100">
                    <thead class="">
                        <tr>
                            <th width="20%">Nome</th>
                            <th width="20%">Email</th>
                            <th width="15%">Telefone</th>
                            <th width="15%">Cidade</th>
                            <th width="10%">Estado</th>
                            <th width="10%">Ativo</th>
                            <th width="10%" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dados serão carregados via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/individuals/index.js') }}"></script>
@endpush
