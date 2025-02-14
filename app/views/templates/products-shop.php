<div class="of-height-200"></div>
<section class="products-shop">
    <div class="site">
        <div class="container-conteudo-loja">
            <div class="search">
                <div class="site">
                    <div class="search-sort">
                        <span>Mostrando 1 - 12 de 18 resultado</span>
                        <div class="sorting">
                            <label for="sort">Classificar:</label>
                            <select id="sort">
                                <option value="default">Padrão</option>
                                <option value="price-low-high">Preço: Menor para Maior</option>
                                <option value="price-high-low">Preço: Maior para Menor</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-list">
                <?php foreach ($listarProduto as $produtos): ?>
                    <div class="product-item">
                        <a href="<?php echo "produto/detalhe/". htmlspecialchars($produtos['link_produto'],ENT_QUOTES,'UTF-8')?>">
                            <img src="<?php
                                        $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $produtos['foto_galeria'];
                                        if ($produtos['foto_galeria'] != "") {
                                            if (file_exists($caminhoArquivo)) {
                                                echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($produtos['foto_galeria'], ENT_QUOTES, 'UTF-8'));
                                            } else {
                                                echo ("http://localhost/sarafashion/public/uploads/produto/sem-foto-produto.png");
                                            }
                                        } else {
                                            echo ("http://localhost/sarafashion/public/uploads/produto/sem-foto-produto.png");
                                        }
                                        ?>" alt="<?php echo htmlspecialchars($produtos['alt_foto_galeria'], ENT_QUOTES, 'UTF-8') ?>">
                            <h4><?php echo htmlspecialchars($produtos['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="price"><span class="old-price">$79.00</span> <?php echo htmlspecialchars($produtos['preco_produto']) ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
                <!-- <div class="product-item">
                <a href="http://localhost/sarafashion/public/produto">
                <img src="assets/img/produto_ILUMINATA.png" alt="Produto 2">
                    <h4>Hair Care Balsam</h4>
                    <p class="price"><span class="old-price">$79.00</span> $59.00</p>
                </a>
                    
                </div>
                <div class="product-item">
                    <a href="http://localhost/sarafashion/public/produto">
                        <img src="assets/img/produto_joico_2.webp" alt="Produto 3">
                        <h4>Hair Care Balsam</h4>
                        <p class="price"><span class="old-price">$79.00</span> $59.00</p>
                    </a>    
                </div>
                <div class="product-item">
                    <a href="http://localhost/sarafashion/public/produto">
                        <img src="assets/img/produto_maquiagem.webp" alt="Produto 3">
                        <h4>Hair Care Balsam</h4>
                        <p class="price"><span class="old-price">$79.00</span> $59.00</p>
                    </a>    
                </div>
                <div class="product-item">
                    <a href="http://localhost/sarafashion/public/produto">
                        <img src="assets/img/produtos_WELLA.jpg" alt="Produto 3">
                        <h4>Hair Care Balsam</h4>
                        <p class="price"><span class="old-price">$79.00</span> $59.00</p>
                    </a>    
                </div>
                <div class="product-item">
                    <a href="http://localhost/sarafashion/public/produto">
                        <img src="assets/img/produto_po_compacto.webp" alt="Produto 3">
                        <h4>Hair Care Balsam</h4>
                        <p class="price"><span class="old-price">$79.00</span> $59.00</p>
                    </a>    
                </div> -->
            </div>
            <div class="paginacao">
                <div class="site">
                    <div class="lista-paginacao">
                        <a href="#" class="pagina ativo">1</a>
                        <a href="#" class="pagina">2</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-aside">
            <aside class="sidebar">
                <div class="search-box">
                    <input type="text" placeholder="Pesquisar...">
                    <button><i class="mkdf-icon-font-awesome fa fa-search "></i></button>
                </div>
                <div class="filter-category">
                    <h3>CATEGORIA</h3>
                    <ul>
                        <li>
                            <a href="#">Coloração</a>
                            <span> (8)</span>
                        </li>
                        <li>
                            <a href="#">Hair Care</a>
                            <span>(7)</span>
                        </li>
                        <li>
                            <a href="#">maquiagem</a>
                            <span>(6)</span>
                        </li>
                    </ul>
                </div>
                <div class="promo">
                    <img src="assets/img/promo.png" alt="Promoção">
                </div>
                <div class="tags">
                    <h3>TAGS</h3>
                    <p>blends, fashion, gloss, haircut, hidratante, selagem, trends</p>
                </div>
                <div class="filter-widget">
                    <div class="filter-title">
                        <h4>Filtrar</h4>
                    </div>
                    <form method="get" action="#">
                        <div class="slider-wrap">
                            <div class="slider">
                                <div class="slider-range"></div>
                                <span class="slider-handle" tabindex="0"></span>
                                <span class="slider-handle" tabindex="0"></span>
                            </div>
                            <div class="slider-amount" data-step="10">
                                <input type="text" id="max-price" name="max_price" value="110" data-max="110"
                                    placeholder="Max price" style="display: none;">
                                <button type="submit" class="btn">Enviar</button>
                                <div class="price-label">
                                    Preço: <span class="from">$40</span> — <span class="to">$210</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="social-sidebar">
                    <div class="titulo-social">
                        <h3>SIGA-NOS</h3>
                    </div>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/studiosarah.fashion/" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <span class="divider">|</span>

                        <a href="https://www.facebook.com/sara.alvesdasilva.79" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <span class="divider">|</span>

                        <a href="https://www.linkedin.com/in/sara-alves-da-silva-6231b8246/" target="_blank">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <span class="divider">|</span>

                        <a href="https://twitter.com" target="_blank">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>