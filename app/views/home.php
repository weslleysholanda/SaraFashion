<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS e bibliotecas -->
    <link rel="stylesheet" href="<?php BASE_URL ?>vendors/css/slick-theme.css">
    <link rel="stylesheet" href="<?php BASE_URL ?>vendors/css/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="<?php BASE_URL ?>vendors/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo isset($titulo) ? $titulo : 'Bem-Vindo a SaraFashion' ?></title>
</head>

<body>

    <!-- Preloader -->
    <?php require_once('templates/preloader.php') ?>

    <!-- cabeçalho -->
    <?php require_once('templates/topo.php') ?>

    <!-- Banner - home -->
    <?php require_once('templates/banner-home.php') ?>

    <!-- Horario Funcionamento -->
    <?php require_once('templates/horario-funcionamento.php') ?>

    <!-- Quem Somos -->
    <?php require_once('templates/quem-somos.php') ?>

    <!-- Satisfacao -->
    <?php require_once('templates/satisfacao.php') ?>

    <!-- Back to top -->
    <a id="backtop" href="#" class="inativo">
        <span class="seta"></span>
    </a>

    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <!-- End VLibras -->

    <!-- Nosso Trabalho -->
    <?php require_once('templates/Nosso-Trabalho.php') ?>

    <!-- Serviços -->
    <?php require_once('templates/servicos.php') ?>

    <!-- Marcas Confiaveis -->
    <?php require_once('templates/marcas-confiaveis.php') ?>

    <!-- Depoimento -->
    <?php require_once('templates/depoimento.php') ?>

    <!-- Loja -->
    <?php require_once('templates/loja.php') ?>

    <!-- footer -->
    <?php require_once('templates/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Waypoints (necessária para detecção de elementos visíveis) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <!--CounterUp -->
    <script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>
    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Slick -->
    <script src="vendors/js/slick.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>


    <script>
        window.addEventListener('scroll', function() {
            const botaoTopo = document.getElementById('backtop');
            if (window.scrollY > 1000) { // Ajuste esse valor conforme necessário
                botaoTopo.classList.add('ativo');
                botaoTopo.classList.remove('inativo');
            } else {
                botaoTopo.classList.add('inativo');
                botaoTopo.classList.remove('ativo');
            }
        });

        // Script para garantir que o botão inicie com a classe 'inativo'
        document.addEventListener("DOMContentLoaded", function() {
            const botaoTopo = document.getElementById('backtop');
            if (botaoTopo) {
                botaoTopo.classList.add('inativo'); // Garante que o botão comece com a classe 'inativo'

                botaoTopo.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });

        // tooltip
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl, {
            customClass: 'custom-tooltip',
            animation: true,
        }));
    </script>

    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <?php
    if (isset($msg) && $tipo_msg == 'erro-tipo_usuario'): ?>
    <?php endif; ?>


</body>

</html>