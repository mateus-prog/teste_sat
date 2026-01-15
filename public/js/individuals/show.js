$(document).ready(function() {
    const pathSegments = window.location.pathname.split('/');
    const individualId = pathSegments[pathSegments.length - 1];

    // Carregar dados do individual
    loadIndividual();

    function loadIndividual() {
        setTimeout(function() {
            $.ajax({
                url: `/api/v1/individual/${individualId}`,
                type: 'GET',
                success: function(response) {
                    const individual = response.data || response;
                    
                    if (!individual || !individual.id) {
                        $('#loading').hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: 'Dados não encontrados'
                        }).then(() => {
                            window.location.href = '/individuals';
                        });
                        return;
                    }
                    
                    $('#name').text(individual.name);
                    $('#document').text(formatCPFDisplay(individual.document));
                    $('#mail').text(individual.mail || '-');
                    $('#phone').text(formatPhoneDisplay(individual.phone));
                    $('#cep').text(formatCEPDisplay(individual.cep));
                    $('#address').text(individual.address);
                    $('#number').text(individual.number);
                    $('#complement').text(individual.complement || '-');
                    $('#district').text(individual.district);
                    $('#city').text(individual.city);
                    $('#state').text(individual.state);
                    
                    // Formatar campo Ativo com badge
                    if (individual.active === 1 || individual.active === true) {
                        $('#active').html('<span class="badge bg-success">Sim</span>');
                    } else {
                        $('#active').html('<span class="badge bg-secondary">Não</span>');
                    }
                    
                    // Configurar link de editar
                    $('#editBtn').attr('href', `/individuals/${individual.id}/edit`);

                    $('#loading').hide();
                    $('#showContent').show();
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
        }, 500);
    }

    // Formatar CPF para exibição
    function formatCPFDisplay(cpf) {
        if (!cpf) return '-';
        const cpfStr = String(cpf).padStart(11, '0');
        return cpfStr.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    }

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

    // Formatar CEP para exibição
    function formatCEPDisplay(cep) {
        if (!cep) return '-';
        const cepStr = String(cep).padStart(8, '0');
        return cepStr.replace(/(\d{5})(\d{3})/, '$1-$2');
    }
});
