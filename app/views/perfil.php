<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://sarafashion.webdevsolutions.com.br/public/vendors/css/reset.css">
    <!-- Pikaday CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://sarafashion.webdevsolutions.com.br/public/assets/css/style.css">
</head>

<body>
    <!-- Preloader -->
    <?php require_once('templates/preloader.php') ?>
    <!-- Menu Cliente -->
    <?php require_once('templates/topo-loja.php') ?>
    <!-- Perfil Cliente -->
    <?php require_once('templates/menu-cliente.php') ?>
    <!-- Popperjs -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha256-BRqBN7dYgABqtY9Hd4ynE+1slnEw+roEPFzQ7TRRfcg=" crossorigin="anonymous"></script>
    <!-- Pikaday JS -->
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <!-- Moment.js (necessário para formatação dd/mm/yyyy) -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/locale/pt-br.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <!-- Waypoints (necessária para detecção de elementos visíveis) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        function changeTab(event, tabId) {
            // Esconde todas as abas
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Mostra a aba específica
            document.getElementById(tabId).classList.add('active');

            // Remove 'active' dos links laterais
            document.querySelectorAll('.sidebar a').forEach(item => {
                item.classList.remove('active');
            });

            // Se foi clicado manualmente, adiciona 'active'
            if (event && event.target) {
                event.target.classList.add('active');
            }

            // Atualiza o hash da URL sem recarregar a página
            history.replaceState(null, null, '#' + tabId);
        }

        // Função para abrir aba com base no hash da URL
        function openTabFromHash() {
            let hash = window.location.hash.replace('#', '');
            if (!hash) hash = 'dados'; // Aba padrão

            // Verifica se existe uma aba com esse id
            if (document.getElementById(hash)) {
                changeTab(null, hash);

                // Também ativa o link da sidebar correspondente
                document.querySelectorAll('.sidebar a').forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('onclick')?.includes("'" + hash + "'")) {
                        item.classList.add('active');
                    }
                });
            }
        }

        // Quando a página carregar
        window.addEventListener('DOMContentLoaded', openTabFromHash);

        // Também abre a aba quando o hash mudar (exemplo: usuário muda manualmente ou volta no histórico)
        window.addEventListener('hashchange', openTabFromHash);


        // Ao carregar a página, pega o parâmetro 'tab' da URL e abre a aba certa
        window.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const tab = params.get('tab') || 'dados';
        });


        function editarPerfil() {
            document.getElementById("dados").classList.remove("active");
            document.getElementById("editar").classList.add("active");
        }

        function cancelarEdicao() {
            document.getElementById("editar").classList.remove("active");
            document.getElementById("dados").classList.add("active");
        }

        $('#form-editar-perfil').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: '<?= BASE_URL ?>perfil/editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.sucesso) {
                        // Exibe a mensagem de sucesso usando a estrutura de alerta do Bootstrap
                        $('.mensagem-container').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sucesso!</strong> ${response.mensagem}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);

                        if (response.novaFoto) {
                            $('#preview-img').attr('src', '<?= BASE_URL ?>uploads/' + response.novaFoto);
                        }

                        atualizarDados(response.cliente);

                        changeTab(null, 'dados');
                    } else {
                        // Exibe a mensagem de erro usando a estrutura de alerta do Bootstrap
                        $('#mensagem-container').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erro!</strong> ${response.mensagem}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição:', xhr.responseText);
                    // Exibe a mensagem de erro em caso de falha na requisição
                    $('#mensagem-container').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erro!</strong> Ocorreu um erro na requisição.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
                }
            });
        });

        // Função para atualizar os dados na aba "dados"
        function atualizarDados(cliente) {
            // Atualiza os campos da aba dados com os novos valores
            $('#dados .info-box strong:contains("Nome") + span').text(cliente.nome_cliente);
            $('#dados .info-box strong:contains("Email") + span').text(cliente.email_cliente);
            $('#dados .info-box strong:contains("Endereço") + span').text(cliente.endereco_cliente);
            $('#dados .info-box strong:contains("Bairro") + span').text(cliente.bairro_cliente);
            $('#dados .info-box strong:contains("CPF") + span').text(cliente.cpf_cnpj_cliente);
            $('#dados .info-box strong:contains("Telefone") + span').text(cliente.telefone_cliente);

            // Atualiza a data de nascimento (formato d/m/Y)
            let dataNascimento = cliente.data_nasc_cliente;
            if (dataNascimento === '0000-00-00' || !dataNascimento) {
                dataNascimento = '00/00/0000';
            } else {
                let partes = dataNascimento.split('-');
                dataNascimento = `${partes[2]}/${partes[1]}/${partes[0]}`;
            }
            $('#dados .info-box strong:contains("Data de nascimento") + span').text(dataNascimento);

            // Atualiza a foto do usuário, adicionando timestamp para evitar cache
            if (cliente.foto_cliente) {
                $('.userImage img').attr('src', `https://sarafashion.webdevsolutions.com.br/public/uploads/${cliente.foto_cliente}?t=${new Date().getTime()}`);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const visualizarImg = document.getElementById('preview-img');
            const arquivo = document.getElementById('foto_cliente');

            visualizarImg.addEventListener('click', function() {
                arquivo.click()
            })

            arquivo.addEventListener('change', function() {
                if (arquivo.files && arquivo.files[0]) {
                    let render = new FileReader();
                    render.onload = function(e) {
                        visualizarImg.src = e.target.result
                    }

                    render.readAsDataURL(arquivo.files[0]);

                }

            })
        })

        moment.locale('pt-br');

        new Pikaday({
            field: document.getElementById('data_nasc_cliente'),
            format: 'DD/MM/YYYY',
            i18n: {
                previousMonth: 'Mês anterior',
                nextMonth: 'Próximo mês',
                months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb']
            },
            toString(date) {
                return moment(date).format('DD/MM/YYYY');
            },
            parse(dateString) {
                const d = moment(dateString, 'DD/MM/YYYY');
                return d.isValid() ? d.toDate() : null;
            },
            minDate: new Date(1920, 0, 1),
            maxDate: new Date(),
            yearRange: [1920, new Date().getFullYear()],
            showDaysInNextAndPreviousMonths: true
        });


        $(document).ready(function() {
            // Aplica a máscara de telefone adaptável (fixo e celular)
            $('input[name="telefone_cliente"]').mask('(00) 00000-0009');
            $('input[name="data_nasc_cliente"]').mask('00/00/0000');
            $('input[name="cpf_cnpj_cliente"]').mask('000.000.000-00');
        });
    </script>
</body>

</html>