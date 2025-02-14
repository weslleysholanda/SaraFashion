<section class="Product">
    <div class="site">
        <div class="product-container">
            <div class="product-images">
                <div class="thumbnail-container">
                    <a href="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" data-lightbox="roadtrip">
                        <img src="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" alt="Round Brush">
                    </a>
                    <a href="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" data-lightbox="roadtrip">
                        <img src="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" alt="Round Brush">
                    </a>
                    <a href="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" data-lightbox="roadtrip">
                        <img src="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" alt="Round Brush">
                    </a>
                </div>

                <div class="main-image">
                    <a href="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" data-lightbox="roadtrip">
                        <img src="http://localhost/sarafashion/public/assets/img/testeProduto.jpg" alt="Round Brush Main">
                    </a>
                </div>

            </div>
            <div class="product-details">
                <div class="product-details-info">
                    <h3><?php echo ($detalhe['nome_produto']) ?></h3>
                    <p class="price">$<?php echo ($detalhe['preco_produto']) ?></p>
                    <div class="product-description">
                        <small>
                            Estoque: <?php echo ($detalhe['quantidade_estoque_produto']) ?>
                        </small>
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