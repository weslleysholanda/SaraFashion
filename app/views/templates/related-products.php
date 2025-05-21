<section class="related-products">
    <div class="site">
        <h3>Produtos Sugeridos</h3>
        <div class="products">
            <?php foreach ($listarProduto as $produto): ?>
                <div class="product">
                    <a href="/produto/detalhe/<?php echo htmlspecialchars($produto['link_produto'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php
                            // Trata imagem principal com fallback
                            $imagens = explode(',', $produto['imagens']);
                            $imagemPrincipal = $imagens[3] ?? ($imagens[0] ?? 'produto/sem-foto-produto.png');

                            // Se a posição 3 existir, mova ela pra primeira posição
                            if (isset($imagens[3])) {
                                unset($imagens[3]);
                                array_unshift($imagens, $imagemPrincipal);
                            }

                            // Verifica existência do arquivo
                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $imagemPrincipal;
                            if (!file_exists($caminhoArquivo)) {
                                $imagemPrincipal = 'produto/sem-foto-produto.png';
                            }
                        ?>

                        <img src="/uploads/<?php echo htmlspecialchars($imagemPrincipal, ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($produto['alt_foto_galeria'] ?? 'Imagem do produto', ENT_QUOTES, 'UTF-8'); ?>">
                        <h4><?php echo htmlspecialchars($produto['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <div class="price"><?php echo htmlspecialchars($produto['preco_produto'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
