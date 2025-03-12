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

                            // Verifica se a posição 3 existe
                            if (isset($imagens[3])) {
                                // Se a posição 3 existe, ela se torna a principal
                                $imagemPrincipal = $imagens[3];
                                unset($imagens[3]); // Remove a posição 3
                                array_unshift($imagens, $imagemPrincipal); // Coloca a posição 3 na primeira posição
                            } else {
                                // Caso contrário, usa a primeira imagem ou a imagem padrão
                                $imagemPrincipal = $imagens[0] ?? 'produto/sem-foto-produto.png';
                            }

                            // Verifica o caminho da imagem
                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $imagemPrincipal;

                            if (!file_exists($caminhoArquivo)) {
                                // Se o arquivo não existir, usa a imagem padrão
                                $imagemPrincipal = "produto/sem-foto-produto.png";
                            }
                            ?>

                            <!-- Exibe a imagem principal -->
                            <img src="http://localhost/sarafashion/public/uploads/<?php echo htmlspecialchars($imagemPrincipal, ENT_QUOTES, 'UTF-8'); ?>"
                                alt="<?php echo htmlspecialchars($produtos['alt_foto_galeria'] ?? 'Imagem do produto', ENT_QUOTES, 'UTF-8'); ?>">

                            <h4><?php echo htmlspecialchars($produtos['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="price"><span class="old-price">$79.00</span> <?php echo htmlspecialchars($produtos['preco_produto'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </a>
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