<header class="topo">

    <div class="site">
        <div class="logo">
            <img src="https://sarafashion.webdevsolutions.com.br/public/assets/img/logoInicial.png" alt="Logo">
        </div>

        <!-- Botão de menu (hambúrguer) -->
        <div class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav class="menu" id="menu">
            <ul>
                <li>
                    <a href="<?php BASE_URL?>home">Home</a>
                </li>
                <li>
                    <a href="<?php BASE_URL?>sobre">Sobre</a>
                </li>
                <li>
                    <a href="<?php BASE_URL?>servico">Serviços</a>
                </li>
                <li>
                    <a href="<?php BASE_URL?>contato">Contato</a>
                </li>
                <li>
                    <a href="<?php BASE_URL?>loja">Loja</a>
                </li>
            </ul>

            <div class="user">
                <div class="sacolaCompra">
                    <a href="https://sarafashion.webdevsolutions.com.br/public/carrinho">
                        <span class="cartIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                y="0px" width="15px" height="20px" viewBox="0 0 15 20" enable-background="new 0 0 15 20"
                                xml:space="preserve">
                                <g>
                                    <defs>
                                        <rect id="SVGID_1_" width="15" height="20"></rect>
                                    </defs>
                                    <clipPath id="SVGID_2_">
                                        <use xlink:href="#SVGID_1_" overflow="visible"></use>
                                    </clipPath>
                                    <path clip-path="url(#SVGID_2_)"
                                        d="M14.16,4.034h-2.965V3.695C11.195,1.658,9.538,0,7.5,0C5.463,0,3.805,1.658,3.805,3.695v0.339
                                    H0.846L0.492,20h14.016L14.16,4.034z M5.424,3.695c0-1.145,0.931-2.077,2.076-2.077c1.145,0,2.077,0.932,2.077,2.077v0.339H5.424
                                    V3.695z M2.147,18.381L2.43,5.652h1.375v1.745h1.619V5.652h4.153v1.745h1.618V5.652h1.381l0.277,12.729H2.147z">
                                    </path>
                                </g>
                            </svg>
                        </span>
                        <span class="cartNumber">0</span>
                    </a>
                </div>
                <div class="separator"></div>
                <div class="userIcon">
                    <a href="https://sarafashion.webdevsolutions.com.br/public/login">
                        <span class="user">
                            <svg viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.4472 13.2001C15.1345 11.9094 16.25 9.7029 16.25 7.20003C16.25 3.22983 13.4464 0 10 0C6.55364 0 3.74997 3.22983 3.74997 7.20003C3.74997 9.70321 4.86553 11.9097 6.55283 13.2001C2.73488 14.8231 0 19.0451 0 24H1.66671C1.66671 18.7063 5.40476 14.4001 10 14.4001C14.5952 14.4001 18.3333 18.7063 18.3333 24H20C20 19.0451 17.2651 14.8231 13.4472 13.2001ZM10 12.48C7.47285 12.48 5.41668 10.1113 5.41668 7.20003C5.41668 4.28876 7.47285 1.92005 10 1.92005C12.5272 1.92005 14.5833 4.28876 14.5833 7.20003C14.5833 10.1113 12.5272 12.48 10 12.48Z" fill="white"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </nav>
        <div class="user">
            <div class="sacolaCompra">
                <a href="https://sarafashion.webdevsolutions.com.br/public/carrinho">
                    <span class="cartIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                            y="0px" width="15px" height="20px" viewBox="0 0 15 20" enable-background="new 0 0 15 20"
                            xml:space="preserve">
                            <g>
                                <defs>
                                    <rect id="SVGID_1_" width="15" height="20"></rect>
                                </defs>
                                <clipPath id="SVGID_2_">
                                    <use xlink:href="#SVGID_1_" overflow="visible"></use>
                                </clipPath>
                                <path clip-path="url(#SVGID_2_)"
                                    d="M14.16,4.034h-2.965V3.695C11.195,1.658,9.538,0,7.5,0C5.463,0,3.805,1.658,3.805,3.695v0.339
                                    H0.846L0.492,20h14.016L14.16,4.034z M5.424,3.695c0-1.145,0.931-2.077,2.076-2.077c1.145,0,2.077,0.932,2.077,2.077v0.339H5.424
                                    V3.695z M2.147,18.381L2.43,5.652h1.375v1.745h1.619V5.652h4.153v1.745h1.618V5.652h1.381l0.277,12.729H2.147z">
                                </path>
                            </g>
                        </svg>
                    </span>
                    <span class="cartNumber">0</span>
                </a>
            </div>
            <div class="separator"></div>
            <div class="userIcon">
                <div class="dropdown">
                    <?php

                    if ($usuario): ?>
                        <!-- Usuário logado: mostra a imagem -->
                        <div class="userImage">
                            <img src="<?php
                                        $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $_SESSION['userFoto'];
                                        if ($_SESSION['userFoto'] != "") {
                                            if (file_exists($caminhoArquivo)) {
                                                echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/" . htmlspecialchars($_SESSION['userFoto'], ENT_QUOTES, 'UTF-8'));
                                            } else {
                                                echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/cliente/sem-foto-cliente.png");
                                            }
                                        } else {
                                            echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/cliente/sem-foto-cliente.png");
                                        }
                                        ?>" class="user-image rounded-circle shadow" alt="User Image" />
                        </div>
                    <?php else: ?>
                        <!-- Não logado: mostra o ícone SVG -->
                        <span class="user">
                            <svg viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.4472 13.2001C15.1345 11.9094 16.25 9.7029 16.25 7.20003C16.25 3.22983 13.4464 0 10 0C6.55364 0 3.74997 3.22983 3.74997 7.20003C3.74997 9.70321 4.86553 11.9097 6.55283 13.2001C2.73488 14.8231 0 19.0451 0 24H1.66671C1.66671 18.7063 5.40476 14.4001 10 14.4001C14.5952 14.4001 18.3333 18.7063 18.3333 24H20C20 19.0451 17.2651 14.8231 13.4472 13.2001ZM10 12.48C7.47285 12.48 5.41668 10.1113 5.41668 7.20003C5.41668 4.28876 7.47285 1.92005 10 1.92005C12.5272 1.92005 14.5833 4.28876 14.5833 7.20003C14.5833 10.1113 12.5272 12.48 10 12.48Z" fill="white"></path>
                            </svg>
                        </span>
                    <?php endif; ?>

                    <div class="dropdownContent">
                        <a href="<?php echo $usuario ? BASE_URL . 'perfil' : BASE_URL . 'login'; ?>">Meu Perfil</a>
                        <a href="<?php echo $usuario ? BASE_URL . 'perfil#pedidos' : BASE_URL . 'login'; ?>">Meus Pedidos</a>
                        <a href="<?php echo $usuario ? BASE_URL . 'perfil#favoritos' : BASE_URL . 'login'; ?>">Meus Favoritos</a>
                        <a href="<?php echo BASE_URL; ?>perfil/logout">Sair</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</header>