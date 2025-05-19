    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loja Sara Fashion</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://sarafashion.webdevsolutions.com.br/public/vendors/css/reset.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
        <!-- Preloader -->
        <?php require_once('templates/preloader.php') ?>
        <!-- Header -->
        <?php require_once('templates/topo-loja.php') ?>

        <!-- Banner Loja -->
        <?php require_once('templates/banner-loja.php') ?>

        <!-- loja de produtos -->
        <?php require_once('templates/products-shop.php') ?>

        <!-- footer -->
        <?php require_once('templates/footer.php') ?>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="vendors/js/slick.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
        <script src="assets/js/script.js"></script>

        <script>
            document.querySelectorAll(".favoriteProduct").forEach((heart) => {
                heart.addEventListener("click", () => {
                    heart.classList.toggle("ativo");
                });
            });

            $(function() {
                const minPrice = 40;
                const maxPrice = 800;

                $(".slider").slider({
                    range: true,
                    min: minPrice,
                    max: maxPrice,
                    values: [minPrice, maxPrice],
                    slide: function(event, ui) {
                        $(".from").text(`$${ui.values[0]}`);
                        $(".to").text(`$${ui.values[1]}`);
                        $("#max-price").val(ui.values[1]);
                    }
                });

                $(".from").text(`$${$(".slider").slider("values", 0)}`);
                $(".to").text(`$${$(".slider").slider("values", 1)}`);
                $("#max-price").val($(".slider").slider("values", 1));
            });
        </script>
    </body>

    </html>