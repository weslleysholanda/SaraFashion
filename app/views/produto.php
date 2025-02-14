<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo) ? $titulo : 'Detalhe - Produto' ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/lightbox.min.css">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/vendors/css/reset.css">
    <link rel="stylesheet" href="http://localhost/sarafashion/public/assets/css/style.css">
</head>

<body>
    <!-- Topo Loja -->
    <?php require_once('templates/topo-loja.php') ?>
    <!-- Banner/header Produto -->
    <?php require_once('templates/banner-produto.php') ?>

    <!-- Produtos -->
    <?php require_once('templates/produtos.php') ?>

    <!-- Sessão tab-->
    <?php require_once('templates/tabs-section.php') ?>

    <!--Produtos relacionados-->
    <?php require_once('templates/related-products.php') ?>

    <!-- footer -->
    <?php require_once('templates/footer.php') ?>

    <script src="https://kit.fontawesome.com/89bd08d7e0.js" crossorigin="anonymous"></script>
    <script src="http://localhost/sarafashion/public/vendors/js/lightbox.min.js"></script>
    <script>
        //contador
        const valorSpan = document.getElementById('valor');
        const incrementarBtn = document.getElementById('incrementar');
        const decrementarBtn = document.getElementById('decrementar');

        incrementarBtn.addEventListener('click', () => {
            valorSpan.textContent = parseInt(valorSpan.textContent) + 1;
        });

        decrementarBtn.addEventListener('click', () => {
            const atual = parseInt(valorSpan.textContent);
            if (atual > 0) {
                valorSpan.textContent = atual - 1;
            }
        });
        /**
         * Controla o comportamento das abas e conteúdos do layout.
         *
         * @param {Event} event - Evento disparado no clique de uma aba.
         * @param {string} tabId - ID do conteúdo que corresponde à aba clicada.
         */
        function showTabContent(event, tabId) {
            const tabs = document.querySelectorAll('.tab'); // Seleciona todas as abas
            const tabContents = document.querySelectorAll('.tab-content'); // Seleciona todos os conteúdos das abas
            const relatedProducts = document.querySelector('.related-products'); // Seleciona os produtos relacionados

            // Verifica se o elemento relacionado a produtos existe antes de manipular
            if (!relatedProducts) {
                console.warn("Elemento '.related-products' não encontrado.");
                return;
            }

            // Remove a classe 'active' de todas as abas e conteúdos
            tabs.forEach(tab => tab.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Adiciona a classe 'active' à aba clicada
            event.target.classList.add('active');

            // Ativa o conteúdo da aba correspondente
            const activeContent = document.getElementById(tabId);
            if (activeContent) {
                activeContent.classList.add('active');
            } else {
                console.error(`Conteúdo com ID "${tabId}" não encontrado.`);
            }

            // Exibe ou oculta a seção de produtos relacionados dependendo da aba
            relatedProducts.style.display = (tabId === 'reviews') ? 'none' : 'block';
        }


        lightbox.option({
            'albumLabel': "Imagem %1 de %2"
        });

        document.addEventListener("DOMContentLoaded", function () {
        document.querySelector(".main-image a").addEventListener("click", function (e) {
            e.preventDefault(); // Impede o comportamento padrão do link

            let imagens = document.querySelectorAll('[data-lightbox="roadtrip"]');

            if (imagens.length > 0) {
                setTimeout(() => {
                    imagens[0].click();
                }, 100);
            } else {
                console.error("Nenhuma imagem encontrada");
            }
        });
    });
            
    </script>
</body>

</html>