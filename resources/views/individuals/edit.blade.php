@extends('layouts.app')

@section('title', 'Editar Pessoa')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i> Editar
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

                <form id="editForm" style="display: none;">
                    <input type="hidden" id="individualId" name="id">
                    
                    <div class="row">
                        <!-- Nome -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="80" required>
                        </div>

                        <!-- CPF -->
                        <div class="col-md-6 mb-3">
                            <label for="document" class="form-label">CPF <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="document" name="document" placeholder="000.000.000-00" maxlength="14" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="mail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="mail" name="mail" maxlength="100" required>
                        </div>

                        <!-- Telefone -->
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="(00) 00000-0000" maxlength="15" required>
                        </div>

                        <!-- CEP -->
                        <div class="col-md-4 mb-3">
                            <label for="cep" class="form-label">CEP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" maxlength="9" required>
                        </div>

                        <!-- Endereço -->
                        <div class="col-md-8 mb-3">
                            <label for="address" class="form-label">Endereço <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" maxlength="50" required>
                        </div>

                        <!-- Número -->
                        <div class="col-md-3 mb-3">
                            <label for="number" class="form-label">Número <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="number" name="number" maxlength="10" required>
                        </div>

                        <!-- Complemento -->
                        <div class="col-md-3 mb-3">
                            <label for="complement" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complement" name="complement" maxlength="20">
                        </div>

                        <!-- Bairro -->
                        <div class="col-md-6 mb-3">
                            <label for="district" class="form-label">Bairro <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="district" name="district" maxlength="60" required>
                        </div>

                        <!-- Cidade -->
                        <div class="col-md-8 mb-3">
                            <label for="city" class="form-label">Cidade <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" maxlength="60" required>
                        </div>

                        <!-- Estado -->
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-select" id="state" name="state" required>
                                <option value="">Selecione...</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>

                        <!-- Ativo -->
                        <div class="col-md-4 mb-3">
                            <label for="active" class="form-label">Ativo <span class="text-danger">*</span></label>
                            <select class="form-select" id="active" name="active" required>
                                <option value="">Selecione...</option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ url('/individuals') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-warning" id="submitBtn">
                            <i class="bi bi-save"></i> Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/individuals/edit.js') }}"></script>
@endpush
