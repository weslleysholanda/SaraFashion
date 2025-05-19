<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SaraFashion</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://sarafashion.webdevsolutions.com.br/public/vendors/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- topo loja -->
    <?php require_once('templates/topo-loja.php')?>
    
    <!-- Login -->
    <?php require_once('templates/login.php')?>
    <script src="assets/js/login.js"></script>
    <?php 
        if(isset($msg) && $tipo_msg == 'erro-tipo_usuario'):?>
    <?php endif; ?>
</body>

</html>