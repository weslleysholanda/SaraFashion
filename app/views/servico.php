<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="vendors/css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php  echo isset($titulo)?$titulo: 'Serviços - Sara Fashion' ?></title>
</head>
<body>

    <!-- Preloader -->
    <?php require_once('templates/preloader.php')?>

    <!-- cabeçalho -->
    <?php  require_once('templates/topo.php')?>
    <!-- BANNER -->
    <?php  require_once('templates/banner-servico.php')?>
    
    <!-- Desejados -->
    <?php  require_once('templates/desejados.php')?>
    
    <!-- Dia Das Noivas -->
    <?php  require_once('templates/noivas.php')?>
    
    <!-- vale presente -->
    <?php  require_once('templates/vale-presente.php')?>
    
    <!-- estetica -->
    <?php  require_once('templates/estetica.php')?>

    <!-- footer -->
    <?php  require_once('templates/footer.php')?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>