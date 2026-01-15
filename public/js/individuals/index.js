$(document).ready(function() {
    // Inicializar DataTable
    const table = $('#individualsTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '/api/v1/individual',
            type: 'GET',
            dataSrc: 'data',
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao carregar',
                    text: xhr.responseJSON?.message || 'Erro desconhecido ao carregar dados'
                });
            }
        },
        columns: [
            { data: 'name' },
            { data: 'mail' },
            { 
                data: 'phone',
                render: function(data) {
                    return formatPhoneDisplay(data);
                }
            },
            { data: 'city' },
            { data: 'state' },
            {
                data: 'active',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data) {
                    if (data === 1 || data === true || data === 'Sim') {
                        return '<span class="badge bg-success">Sim</span>';
                    } else {
                        return '<span class="badge bg-danger">Não</span>';
                    }
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return `
                        <a href="/individuals/${row.id}" class="btn btn-sm btn-info" title="Visualizar">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="/individuals/${row.id}/edit" class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                }
            }
        ],
        order: [[0, 'desc']],
        pageLength: 10,
        responsive: true
    });

    // Formatar telefone para exibição
    function formatPhoneDisplay(phone) {
        if (!phone) return '-';
        const phoneStr = String(phone);
        if (phoneStr.length === 11) {
            return phoneStr.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (phoneStr.length === 10) {
            return phoneStr.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
        return phoneStr;
    }

    // Abrir SweetAlert de confirmação de exclusão
    $(document).on('click', '.delete-btn', function() {
        const deleteId = $(this).data('id');
        
        Swal.fire({
            title: 'Confirmar Exclusão',
            text: 'Tem certeza que deseja excluir este registro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteIndividual(deleteId);
            }
        });
    });

    // Função para deletar individual
    function deleteIndividual(id) {
        Swal.fire({
            title: 'Excluindo...',
            text: 'Aguarde enquanto excluímos o registro',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: `/api/v1/individual/${id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Excluído!',
                    text: 'Registro excluído com sucesso!',
                    timer: 2000,
                    showConfirmButton: false
                });
                table.ajax.reload(null, false); // Recarregar DataTable sem resetar paginação
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao excluir',
                    text: xhr.responseJSON?.message || 'Erro desconhecido ao excluir registro'
                });
            }
        });
    }
});
