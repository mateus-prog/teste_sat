$(document).ready(function() {
    const pathSegments = window.location.pathname.split('/');
    const individualId = pathSegments[pathSegments.length - 2];

    // Carregar dados do individual
    loadIndividual();

    function loadIndividual() {
        $.ajax({
            url: `/api/v1/individual/${individualId}`,
            type: 'GET',
            success: function(response) {
                const individual = response;
                
                $('#individualId').val(individual.id);
                $('#name').val(individual.name);
                $('#document').val(formatCPFDisplay(individual.document));
                $('#mail').val(individual.mail);
                $('#phone').val(formatPhoneDisplay(individual.phone));
                $('#cep').val(formatCEPDisplay(individual.cep));
                $('#address').val(individual.address);
                $('#number').val(individual.number);
                $('#complement').val(individual.complement || '');
                $('#district').val(individual.district);
                $('#city').val(individual.city);
                $('#state').val(individual.state);
                $('#active').val(individual.active);

                $('#loading').hide();
                $('#editForm').show();
            },
            error: function(xhr) {
                $('#loading').hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao carregar',
                    text: xhr.responseJSON?.message || 'Erro desconhecido ao carregar dados'
                }).then(() => {
                    window.location.href = '/individuals';
                });
            }
        });
    }

    // Formatar CPF para exibição
    function formatCPFDisplay(cpf) {
        if (!cpf) return '';
        const cpfStr = String(cpf).padStart(11, '0');
        return cpfStr.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    }

    // Formatar telefone para exibição
    function formatPhoneDisplay(phone) {
        if (!phone) return '';
        const phoneStr = String(phone);
        if (phoneStr.length === 11) {
            return phoneStr.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (phoneStr.length === 10) {
            return phoneStr.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
        return phoneStr;
    }

    // Formatar CEP para exibição
    function formatCEPDisplay(cep) {
        if (!cep) return '';
        const cepStr = String(cep).padStart(8, '0');
        return cepStr.replace(/(\d{5})(\d{3})/, '$1-$2');
    }

    // Máscaras de formatação
    $('#document').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        $(this).val(value);
    });

    $('#phone').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length <= 10) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
        } else {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        }
        $(this).val(value);
    });

    $('#cep').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        $(this).val(value);
    });

    // Buscar endereço por CEP
    $('#cep').on('blur', function() {
        const cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            $.ajax({
                url: `https://viacep.com.br/ws/${cep}/json/`,
                type: 'GET',
                success: function(data) {
                    if (!data.erro) {
                        $('#address').val(data.logradouro);
                        $('#district').val(data.bairro);
                        $('#city').val(data.localidade);
                        $('#state').val(data.uf);
                        if (data.complemento) $('#complement').val(data.complemento);
                    }
                }
            });
        }
    });

    // Submit do formulário
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        
        clearValidationErrors('editForm');
        
        const submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Atualizando...');

        const formData = {
            name: $('#name').val(),
            document: formatCPF($('#document').val()),
            mail: $('#mail').val(),
            phone: formatPhone($('#phone').val()),
            cep: formatCEP($('#cep').val()),
            address: $('#address').val(),
            number: $('#number').val(),
            complement: $('#complement').val() || '',
            district: $('#district').val(),
            city: $('#city').val(),
            state: $('#state').val(),
            active: parseInt($('#active').val())
        };

        $.ajax({
            url: `/api/v1/individual/${individualId}`,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Registro atualizado com sucesso!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '/individuals';
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Erros de validação
                    displayValidationErrors(xhr.responseJSON.errors, 'editForm');
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro de validação',
                        text: 'Por favor, corrija os erros no formulário'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao atualizar',
                        text: xhr.responseJSON?.message || 'Erro desconhecido ao atualizar registro'
                    });
                }
            },
            complete: function() {
                submitBtn.prop('disabled', false).html('<i class="bi bi-save"></i> Atualizar');
            }
        });
    });
});
