<section class="related-products">
    <div class="site">
        <h3>Produtos Sugeridos</h3>
        <div class="products">
            <?php foreach ($listarProduto as $produto): ?>
                <div class="product">
                    <a href="/sarafashion/public/produto/detalhe/<?php echo htmlspecialchars($produto['link_produto'], ENT_QUOTES, 'UTF-8'); ?>">
                        <img src="<?php
                                    $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $produto['foto_galeria'];
                                    if ($produto['foto_galeria'] != "") {
                                        if (file_exists($caminhoArquivo)) {
                                            echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($produto['foto_galeria'], ENT_QUOTES, 'UTF-8'));
                                        } else {
                                            echo ("http://localhost/sarafashion/public/uploads/produto/sem-foto-produto.png");
                                        }
                                    } else {
                                        echo ("http://localhost/sarafashion/public/uploads/produto/sem-foto-produto.png");
                                    } ?>" alt="Product 1">
                        <h4><?php echo htmlspecialchars($produto['nome_produto'], ENT_QUOTES, 'UTF-8') ?></h4>
                        <div class="price"><?php echo htmlspecialchars($produto['preco_produto'], ENT_QUOTES, 'UTF-8') ?></div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>