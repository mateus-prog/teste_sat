// Função auxiliar para obter o CSRF Token
function getCsrfToken() {
    return $('meta[name="csrf-token"]').attr('content');
}

// Configuração global do DataTables em português
$.extend(true, $.fn.dataTable.defaults, {
    language: {
        decimal: ",",
        emptyTable: "Nenhum registro encontrado",
        info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 até 0 de 0 registros",
        infoFiltered: "(Filtrados de _MAX_ registros)",
        infoThousands: ".",
        lengthMenu: "_MENU_ resultados por página",
        loadingRecords: "Carregando...",
        processing: "Processando...",
        zeroRecords: "Nenhum registro encontrado",
        search: "Pesquisar:",
        paginate: {
            first: "Primeiro",
            previous: "Anterior",
            next: "Próximo",
            last: "Último"
        },
        aria: {
            sortAscending: ": Ordenar colunas de forma ascendente",
            sortDescending: ": Ordenar colunas de forma descendente"
        }
    }
});

// Função global para exibir erros de validação
function displayValidationErrors(errors, formId) {
    // Limpar erros anteriores
    $(`#${formId} .is-invalid`).removeClass('is-invalid');
    $(`#${formId} .error-message`).remove();

    // Exibir novos erros
    $.each(errors, function(field, messages) {
        const input = $(`#${formId} [name="${field}"]`);
        input.addClass('is-invalid');
        
        const errorDiv = $('<div class="invalid-feedback error-message"></div>');
        errorDiv.text(messages[0]); // Primeira mensagem de erro
        input.after(errorDiv);
    });
}

// Função global para limpar erros
function clearValidationErrors(formId) {
    $(`#${formId} .is-invalid`).removeClass('is-invalid');
    $(`#${formId} .error-message`).remove();
}

// Função para formatar CPF
function formatCPF(value) {
    return value.replace(/\D/g, '').slice(0, 11);
}

// Função para formatar CEP
function formatCEP(value) {
    return value.replace(/\D/g, '').slice(0, 8);
}

// Função para formatar telefone
function formatPhone(value) {
    return value.replace(/\D/g, '').slice(0, 11);
}
