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
                        <a href="<?php echo "produto/detalhe/" . htmlspecialchars($produtos['link_produto'], ENT_QUOTES, 'UTF-8'); ?>">

                            <?php
                            // Separar as imagens armazenadas no banco
                            $imagens = explode(',', $produtos['imagens']);

                            // Verifica se a posição 3 existe e coloca como principal
                            if (isset($imagens[3])) {
                                $imagemPrincipal = $imagens[3];
                                unset($imagens[3]);
                                array_unshift($imagens, $imagemPrincipal);
                            } else {
                                $imagemPrincipal = $imagens[0] ?? 'produto/sem-foto-produto.png';
                            }

                            // Monta o caminho completo da imagem
                            $caminhoArquivo = BASE_URL . "uploads/" . $imagemPrincipal;

                            // Verifica se a imagem existe no servidor
                            $img = "uploads/produto/sem-foto-produto.png";
                            $alt = "Imagem do produto";

                            if (!empty($imagemPrincipal)) {
                                $headers = @get_headers($caminhoArquivo);
                                if ($headers && strpos($headers[0], '200') !== false) {
                                    $img = "uploads/" . $imagemPrincipal;
                                    $alt = htmlspecialchars($produtos['alt_foto_galeria'] ?? 'Imagem do produto', ENT_QUOTES, 'UTF-8');
                                }
                            }
                            ?>

                            <!-- Exibe a imagem principal -->
                            <img src="<?= $img ?>" alt="<?= $alt ?>">

                            <h4><?php echo htmlspecialchars($produtos['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="price"><span class="old-price">$79.00</span> <?php echo htmlspecialchars($produtos['preco_produto'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </a>

                        <!-- Ícone de coração -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="favoriteProduct" viewBox="0 0 17.59 16.305">
                            <path d="M9.3,3.265h0l-.9-.943a4.2,4.2,0,0,0-6.126,0,4.679,4.679,0,0,0,0,6.406l7.027,7.349,7.027-7.349a4.679,4.679,0,0,0,0-6.406,4.2,4.2,0,0,0-6.126,0l-.9.943h0Z" transform="translate(-0.5 -0.495)" stroke="#c59d5f" stroke-miterlimit="10" stroke-width="1" />
                        </svg>
                    </div>
                <?php endforeach; ?>

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
                    <div class="sub-tags">
                        <a href="">blends</a>, <a href="#">fashion</a>,<a href="#"> gloss</a>, <a href="#">haircut</a>, <a href="#">hidratante</a>,<a href="#">selagem</a>,<a href="#">trends</a>
                    </div>

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