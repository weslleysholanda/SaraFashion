<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/vendors/css/reset.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <!-- Topo Loja -->
    <?php require_once('templates/topo-loja.php') ?>

    <!-- Banner Carrinho -->
    <?php require_once('templates/banner-carrinho.php')?>

    <!-- container-loja -->
    <?php require_once('templates/container-loja.php')?>

    <!-- footer -->
    <?php require_once('templates/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Waypoints (necessária para detecção de elementos visíveis) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <!--CounterUp -->
    <script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>
    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <!-- tippy.js -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <!-- Slick -->
    <script src="vendors/js/slick.min.js"></script>
    <script src="assets/js/script.js"></script>
    <!-- <script>
        // Exemplo de como alternar entre o carrinho vazio e o com itens
        const cartHasItems = false; // Trocar para "true" para mostrar os itens
        if (cartHasItems) {
            document.getElementById('empty-cart').style.display = 'none';
            document.getElementById('cart-items').style.display = 'block';
        }
    </script> -->
</body>

</html>