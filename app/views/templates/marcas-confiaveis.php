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
                <?php

                $caminhoArquivo = BASE_URL . "uploads/" . $marcasLogo['logo_marca'];
                $img = "/uploads/cliente/sem-foto-marca.png";
                $alt_foto = "imagem sem foto";

                if (!empty($marcasLogo['logo_marca'])) {
                    $headers = @get_headers($caminhoArquivo);
                    if ($headers && strpos($headers[0], '200') !== false) {
                        $img = $caminhoArquivo;
                        $alt_foto = htmlspecialchars($marcasLogo['alt_marca'], ENT_QUOTES, 'UTF-8');
                    }
                }

                ?>
                <div>
                    <img src="<?= $img ?>" alt="<?= $alt_foto?>">
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