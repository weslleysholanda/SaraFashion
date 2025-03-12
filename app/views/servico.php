<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="vendors/css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo isset($titulo) ? $titulo : 'Serviços - Sara Fashion' ?></title>
</head>

<body>

    <!-- Preloader -->
    <?php require_once('templates/preloader.php') ?>

    <!-- cabeçalho -->
    <?php require_once('templates/topo.php') ?>
    <!-- BANNER -->
    <?php require_once('templates/banner-servico.php') ?>

    <!-- Desejados -->
    <?php require_once('templates/desejados.php') ?>

    <!-- Back to top -->
    <a id="backtop" href="#" class="ativo">
        <span class="seta"></span>
    </a>

    <!-- Dia Das Noivas -->
    <?php require_once('templates/noivas.php') ?>

    <!-- vale presente -->
    <?php require_once('templates/vale-presente.php') ?>

    <!-- estetica -->
    <?php require_once('templates/estetica.php') ?>

    <!-- footer -->
    <?php require_once('templates/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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

    Fancybox.bind("[data-fancybox]", {
        Thumbs: false,
        Toolbar: {
            display: ["close"],
        },
    });



    window.addEventListener('scroll', function() {
        const botaoTopo = document.getElementById('backtop');
        if (window.scrollY > 1500) {
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