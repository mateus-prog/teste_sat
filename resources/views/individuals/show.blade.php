@extends('layouts.app')

@section('title', 'Visualizar Pessoa')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-eye-fill"></i> Visualizar
                </h5>
            </div>
            <div class="card-body">
                <!-- Loading Spinner -->
                <div id="loading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p class="mt-2">Carregando dados...</p>
                </div>

                <div id="showContent" style="display: none;">
                    <div class="row">
                        <!-- Nome -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Nome</strong>
                            <span id="name">-</span>
                        </div>

                        <!-- CPF -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">CPF</strong>
                            <span id="document">-</span>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Email</strong>
                            <span id="mail">-</span>
                        </div>

                        <!-- Telefone -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Telefone</strong>
                            <span id="phone">-</span>
                        </div>

                        <!-- CEP -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">CEP</strong>
                            <span id="cep">-</span>
                        </div>

                        <!-- Endereço -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Endereço</strong>
                            <span id="address">-</span>
                        </div>

                        <!-- Número -->
                        <div class="col-md-3 mb-3">
                            <strong class="d-block mb-1">Número</strong>
                            <span id="number">-</span>
                        </div>

                        <!-- Complemento -->
                        <div class="col-md-3 mb-3">
                            <strong class="d-block mb-1">Complemento</strong>
                            <span id="complement">-</span>
                        </div>

                        <!-- Bairro -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Bairro</strong>
                            <span id="district">-</span>
                        </div>

                        <!-- Cidade -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Cidade</strong>
                            <span id="city">-</span>
                        </div>

                        <!-- Estado -->
                        <div class="col-md-6 mb-3">
                            <strong class="d-block mb-1">Estado</strong>
                            <span id="state">-</span>
                        </div>

                        <!-- Ativo -->
                        <div class="col-md-4 mb-3">
                            <strong class="d-block mb-1">Ativo</strong>
                            <span id="active">-</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ url('/individuals') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/individuals/show.js') }}"></script>
@endpush
