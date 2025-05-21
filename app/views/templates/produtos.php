<section class="Product">
    <div class="site">
        <div class="product-container">
            <div class="product-images">
                <div class="thumbnail-container">
                    <?php for ($i = 0; $i < 3; $i++) : 
                        $img = !empty($detalhe['imagens'][$i]) ? '/uploads/' . htmlspecialchars($detalhe['imagens'][$i]) : '/assets/img/sem-foto-produto.png';
                    ?>
                        <a href="<?= $img ?>" data-lightbox="roadtrip">
                            <img class="preview-img" data-index="<?= $i ?>" src="<?= $img ?>">
                        </a>
                    <?php endfor; ?>
                </div>

                <div class="main-image">
                    <?php
                        $imgPrincipal = !empty($detalhe['imagens'][3]) ? '/uploads/' . htmlspecialchars($detalhe['imagens'][3]) : '/assets/img/sem-foto-produto.png';
                    ?>
                    <a href="<?= $imgPrincipal ?>" data-lightbox="roadtrip">
                        <img class="preview-img" data-index="3" src="<?= $imgPrincipal ?>">
                    </a>
                </div>
            </div>

            <div class="product-details">
                <div class="product-details-info">
                    <h3><?= htmlspecialchars($detalhe['nome_produto']) ?></h3>
                    <p class="price">$<?= htmlspecialchars($detalhe['preco_produto']) ?></p>
                    <div class="product-description">
                        <small>Estoque: <?= htmlspecialchars($detalhe['quantidade_estoque_produto']) ?></small>
                    </div>
                    <div class="add-to-cart">
                        <div class="contador">
                            <div class="numero">
                                <span id="valor">1</span>
                            </div>
                            <div class="botoes">
                                <button id="incrementar">+</button>
                                <button id="decrementar">-</button>
                            </div>
                        </div>
                        <div class="btn">
                            <button>Adicionar</button>
                        </div>
                    </div>
                    <div class="category">
                        <strong>Categoria:</strong> Hair tools
                    </div>
                    <div class="tags">
                        <strong>Tags:</strong> fashion, corte de cabelo
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
