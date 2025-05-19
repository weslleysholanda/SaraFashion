<div class="of-height-200"></div>
<section class="depoimento">
    <div class="site">
        <div class="container-depoimento">
            <div class="titulo-depoimento">
                <div class="textoFundo">Testimonial</div>
                <h2>Depoimento</h2>
            </div>
            <div class="cards-depoimento">
                <div class="slide-card">
                    <?php foreach ($depoimentoCliente as $depoimentoCliente): ?>
                        <div class="card-slide">
                            <div class="card">
                                <div class="cabecalho-card">
                                    <img src="<?php
                                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $depoimentoCliente['foto_cliente'];
                                            if ($depoimentoCliente['foto_cliente'] != "") {
                                                if (file_exists($caminhoArquivo)) {
                                                    echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/" . htmlspecialchars($depoimentoCliente['foto_cliente'], ENT_QUOTES, 'UTF-8'));
                                                } else {
                                                    echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/cliente/sem-foto-cliente.png");
                                                }
                                            } else {
                                                echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/cliente/sem-foto-cliente.png");
                                            }
                                            ?>" alt="<?php echo htmlspecialchars($depoimentoCliente['alt_foto_cliente'])?>">
                                    <div class="cabecalho-info">
                                        <h3><?php echo htmlspecialchars($depoimentoCliente['nome_cliente'],ENT_QUOTES, 'UTF-8')?></h3>
                                        <small><?php echo htmlspecialchars($depoimentoCliente['nome_servico'],ENT_QUOTES, 'UTF-8')?></small>
                                        <svg width="100" height="18" viewBox="0 0 100 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8 0.879395L9.79611 6.48136H15.6085L10.9062 9.94356L12.7023 15.5455L8 12.0833L3.29772 15.5455L5.09383 9.94356L0.391548 6.48136H6.20389L8 0.879395Z"
                                                fill="#333333" />
                                            <path
                                                d="M29 0.879395L30.7961 6.48136H36.6085L31.9062 9.94356L33.7023 15.5455L29 12.0833L24.2977 15.5455L26.0938 9.94356L21.3915 6.48136H27.2039L29 0.879395Z"
                                                fill="#333333" />
                                            <path
                                                d="M50 0.879395L51.7961 6.48136H57.6085L52.9062 9.94356L54.7023 15.5455L50 12.0833L45.2977 15.5455L47.0938 9.94356L42.3915 6.48136H48.2039L50 0.879395Z"
                                                fill="#333333" />
                                            <path
                                                d="M71 0.879395L72.7961 6.48136H78.6085L73.9062 9.94356L75.7023 15.5455L71 12.0833L66.2977 15.5455L68.0938 9.94356L63.3915 6.48136H69.2039L71 0.879395Z"
                                                fill="#333333" />
                                            <path
                                                d="M92 0.879395L93.7961 6.48136H99.6085L94.9062 9.94356L96.7023 15.5455L92 12.0833L87.2977 15.5455L89.0938 9.94356L84.3915 6.48136H90.2039L92 0.879395Z"
                                                fill="#333333" />
                                        </svg>


                                    </div>
                                    <div class="aspas">
                                        <svg width="71" height="50" viewBox="0 0 71 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.2221 32.6551C11.671 36.5692 9.21918 40.4442 5.93584 44.1738C4.89099 45.3605 4.75834 47.0547 5.606 48.389C6.25875 49.4154 7.35665 50.0001 8.51915 50.0001C8.84667 50.0001 9.17998 49.954 9.50865 49.8583C16.4674 47.8251 32.6996 40.6033 33.1356 17.5196C33.3039 8.60607 26.7846 0.948419 18.2954 0.0857649C13.6166 -0.382478 8.93547 1.13753 5.46646 4.27326C1.99284 7.41244 0 11.894 0 16.5705C0 24.3723 5.53795 31.195 13.2221 32.6551ZM8.63332 7.77801C10.8395 5.78402 13.6166 4.72186 16.5609 4.72186C16.9772 4.72186 17.397 4.74262 17.8179 4.78643C23.8806 5.40111 28.534 10.9552 28.4118 17.4297C28.1108 33.4024 19.4625 40.5929 12.3007 43.8094C14.5669 40.744 16.3475 37.591 17.6138 34.3953C18.1074 33.1509 18.0255 31.7601 17.39 30.5792C16.7246 29.3406 15.5379 28.4618 14.1367 28.1677C8.68176 27.0271 4.72376 22.1488 4.72376 16.5705C4.72376 13.2283 6.14918 10.0234 8.63332 7.77801Z"
                                                fill="#222222" />
                                            <path
                                                d="M43.3264 48.3889C43.9791 49.4153 45.077 50 46.2395 50C46.567 50 46.8992 49.9538 47.229 49.8581C54.1878 47.8249 70.4188 40.6032 70.8548 17.5195C71.0208 8.60591 64.5026 0.948239 56.0123 0.0856085C51.3277 -0.390689 46.6547 1.13622 43.1857 4.27311C39.7121 7.41229 37.7192 11.8939 37.7192 16.5703C37.7192 24.3722 43.2572 31.1949 50.9403 32.6549C49.388 36.5725 46.9361 40.4475 43.6539 44.1748C42.609 45.3627 42.4776 47.0557 43.3264 48.3889ZM55.3318 34.3975C55.8254 33.1531 55.7447 31.7623 55.1104 30.5813C54.4438 29.3416 53.2582 28.4628 51.8559 28.1676C46.4009 27.027 42.443 22.1487 42.443 16.5703C42.443 13.227 43.8684 10.0233 46.3525 7.77786C48.5575 5.78386 51.3346 4.7217 54.28 4.7217C54.6952 4.7217 55.115 4.74246 55.5371 4.78627C61.5987 5.40095 66.2532 10.9551 66.131 17.4295C65.8311 33.4033 57.1817 40.5928 50.0199 43.8092C52.2849 40.7462 54.0633 37.5932 55.3318 34.3975Z"
                                                fill="#222222" />
                                        </svg>

                                    </div>
                                </div>
                                <div class="card-info-depoimento">
                                    <p><?php echo htmlspecialchars($depoimentoCliente['comentario_avaliacao'],ENT_QUOTES, 'UTF-8')?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>