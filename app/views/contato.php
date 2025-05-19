<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo) ? $titulo : 'Contato - Sara Fashion' ?></title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://sarafashion.webdevsolutions.com.br/public/vendors/css/reset.css">
    <link rel="stylesheet" href="https://sarafashion.webdevsolutions.com.br/public/assets/css/style.css">
</head>

<body>
    <!-- Preloader -->
    <?php require_once('templates/preloader.php') ?>

    <!-- Cabecalho -->
    <?php require_once('templates/topo.php') ?>
    <!-- Banner Contato -->
    <?php require_once('templates/banner-map.php') ?>

    <!-- Formulario Contato -->
    <?php require_once('templates/formulario-contato.php') ?>

    <!-- footer -->
    <?php require_once('templates/footer.php') ?>

    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://sarafashion.webdevsolutions.com.br/public/vendors/js/slick.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>
    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://sarafashion.webdevsolutions.com.br/public/assets/js/maps.js"></script>
    <script src="https://sarafashion.webdevsolutions.com.br/public/assets/js/script.js"></script>
</body>

</html>