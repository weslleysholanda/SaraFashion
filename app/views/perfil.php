<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/assets/css/style.css">
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
    <!-- Tempus Dominus JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Waypoints (necessária para detecção de elementos visíveis) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        function changeTab(event, tabId) {
            // Desativa todas as abas
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Ativa a aba escolhida
            document.getElementById(tabId).classList.add('active');

            // Remove classe 'active' dos links laterais
            document.querySelectorAll('.sidebar a').forEach(item => {
                item.classList.remove('active');
            });

            // Só aplica 'active' se veio de um clique
            if (event) {
                event.target.classList.add('active');
            }
        }

        function editarPerfil() {
            document.getElementById("dados").classList.remove("active");
            document.getElementById("editar").classList.add("active");
        }

        function cancelarEdicao() {
            document.getElementById("editar").classList.remove("active");
            document.getElementById("dados").classList.add("active");
        }

        const picker = new tempusDominus.TempusDominus(document.getElementById('dataCadastroPicker'), {
            display: {
                components: {
                    calendar: true,
                    date: true,
                    month: true,
                    year: true,
                    decades: true,
                    clock: false,
                },
                buttons: {
                    today: false,
                    clear: true,
                    close: true,
                },
            },
            localization: {
                locale: 'pt-BR',
                format: 'dd/MM/yyyy',
            }
        });


        document.querySelector('#form-editar-perfil').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            try {
                const response = await fetch('<?= BASE_URL ?>/perfil/editar', {
                    method: 'POST',
                    body: formData
                });

                const json = await response.json();

                const msg = document.querySelector('#mensagem');
                msg.innerText = json.mensagem;
                msg.className = json.sucesso ? 'mensagem sucesso' : 'mensagem erro';

                if (json.sucesso) {
                    if (json.novaFoto) {
                        const img = document.querySelector('.foto-preview img');
                        img.src = '<?= BASE_URL ?>/assets/images/clientes/' + json.novaFoto;
                    }

                    // Trocar para a aba "dados"
                    changeTab(null, 'dados');

                    setTimeout(() => {
                        msg.innerText = '';
                        msg.className = '';
                    }, 3000);
                }

            } catch (error) {
                console.error('Erro na requisição:', error);
            }
        });
    </script>
</body>

</html>