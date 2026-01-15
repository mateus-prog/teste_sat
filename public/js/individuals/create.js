$(document).ready(function() {
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
                        $('#complement').val(data.complemento);
                    }
                }
            });
        }
    });

    // Submit do formulário
    $('#createForm').on('submit', function(e) {
        e.preventDefault();
        
        clearValidationErrors('createForm');
        
        const submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Salvando...');

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
            url: '/api/v1/individual',
            type: 'POST',
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
                    text: 'Cadastro feito com sucesso!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '/individuals';
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Erros de validação
                    displayValidationErrors(xhr.responseJSON.errors, 'createForm');
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro de validação',
                        text: 'Por favor, corrija os erros no formulário'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao cadastrar',
                        text: xhr.responseJSON?.message || 'Erro desconhecido ao cadastrar registro'
                    });
                }
            },
            complete: function() {
                submitBtn.prop('disabled', false).html('<i class="bi bi-save"></i> Salvar');
            }
        });
    });
});
