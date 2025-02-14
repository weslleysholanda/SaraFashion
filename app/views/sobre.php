<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendors/css/reset.css">
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
    <script src="https://unpkg.com/counterup2@2.0.2/dist/index.js">	</script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="vendors/js/slick.js"></script>
    <script src="vendors/js/slick.min.js"></script>
    <!-- tippy.js -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>