<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendors/css/reset.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo isset($titulo) ? $titulo : 'Sobre - Sara Fashion' ?></title>
</head>

<body>
    <!-- Preloader -->
    <?php require_once('templates/preloader.php') ?>

    <!-- cabeçalho -->
    <?php require_once('templates/topo.php') ?>

    <!-- Banner Sobre -->
    <?php require_once('templates/banner-sobre.php') ?>

    <!-- Nossa História -->
    <?php require_once('templates/nossa-historia.php') ?>

    <!-- Back to top -->
    <a id="backtop" href="#" class="ativo">
        <span class="seta"></span>
    </a>

    <!-- Nosso Objetivo -->
    <?php require_once('templates/nosso-objetivo.php') ?>

    <!-- Certificados -->
    <?php require_once('templates/certificados.php') ?>

    <!-- galeria -->
    <?php require_once('templates/galeria.php') ?>

    <!-- footer -->
    <?php require_once('templates/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Waypoints (necessária para detecção de elementos visíveis) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <!-- biblioteca CountUp -->
    <script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"> </script>
    <script src="vendors/js/slick.js"></script>
    <script src="vendors/js/slick.min.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- FancyBox -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <!-- tippy.js -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
<script>
    function abrirModalCertificado() {
        if ($('#modalCertificado').hasClass('show')) {
            return;
        }

        $('#modalCertificado').modal('show');
    }

    document.addEventListener("DOMContentLoaded", function() {
        const filtros = document.querySelectorAll(".filtro");
        const itensGaleria = document.querySelectorAll(".item-galeria");

        filtros.forEach(filtro => {
            filtro.addEventListener("click", function(e) {
                e.preventDefault();

                // Removendo a classe 'ativo' dos filtros
                filtros.forEach(f => f.classList.remove("ativo"));
                this.classList.add("ativo");

                const filtroSelecionado = this.getAttribute("data-filtro");

                itensGaleria.forEach(item => {
                    if (filtroSelecionado === "tudo") {
                        item.style.display = "block";
                    } else {
                        item.style.display = item.classList.contains(filtroSelecionado) ? "block" : "none";
                    }
                });
            });
        });
    });

    window.addEventListener('scroll', function() {
            const botaoTopo = document.getElementById('backtop');
            if (window.scrollY > 1000) {
                botaoTopo.classList.add('ativo');
                botaoTopo.classList.remove('inativo');
            } else {
                botaoTopo.classList.add('inativo');
                botaoTopo.classList.remove('ativo');
            }
        });

        // Script para voltar ao topo ao clicar no botão
        document.getElementById('backtop').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
</script>