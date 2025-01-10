<div class="of-height-200"></div>
<section class="marcas-confiaveis">
    <div class="site">
        <div class="titulo">
            <h2>MARCAS CONFIÁVEIS</h2>
            <div class="tituloFooter">
                <span class="linha"></span>
                <img src="assets/img/IconeHair.png" alt="">
                <span class="linha"></span>
            </div>
        </div>
        <div class="marcas-slider">
        <?php foreach ($marcaLogo as $marcasLogo): ?>
            <div>
                <img src="<?php
                                $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $marcasLogo['logo_marca'];
                                if ($marcasLogo['logo_marca'] != "") {
                                    if (file_exists($caminhoArquivo)) {
                                        echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($marcasLogo['logo_marca'], ENT_QUOTES, 'UTF-8'));
                                    } else {
                                        echo ("http://localhost/sarafashion/public/uploads/marca/sem-foto-marca.png");
                                    }
                                } else {
                                    echo ("http://localhost/sarafashion/public/uploads/marca/sem-foto-marca.png");
                                }
                                ?>" alt="<?php $marcasLogo['alt_marca'] ?>">
            </div>
        <?php endforeach ?>    
            <!-- <div><img src="assets/img/logoIluminata.png" alt=""></div>
            <div><img src="assets/img/logoJoico.png" alt=""></div>
            <div><img src="assets/img/logoWella.png" alt=""></div>
            <div><img src="assets/img/logoInoar.png" alt=""></div>
            <div><img src="assets/img/logoAtivare.png" alt=""></div>
            <div><img src="assets/img/logoIluminata.png" alt=""></div>
            <div><img src="assets/img/logoJoico.png" alt=""></div>
            <div><img src="assets/img/logoWella.png" alt=""></div>
            <div><img src="assets/img/logoInoar.png" alt=""></div> -->
        </div>
    </div>
</section>