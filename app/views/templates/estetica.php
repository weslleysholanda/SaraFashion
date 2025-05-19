<div class="of-height-300"></div>
<div class="of-height-150"></div>
<section class="estetica">
    <div class="site">
        <div class="container-estetica">
            <div class="titulo-estetica">
                <h2>Cuidados e Relaxamento</h2>
                <div class="textoFundo">Bem-estar</div>
            </div>
            <div class="list-estetica">
                <?php foreach($servicos as $servico):?>
                    <div class="card-estetica">
                        <img src="<?php
                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $servico['foto_servico'];
                                        if ($servico['foto_servico'] != "") {
                                            if (file_exists($caminhoArquivo)){
                                                echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/" .htmlspecialchars($servico['foto_servico'], ENT_QUOTES, 'UTF-8'));
                                            } else {
                                                echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/servico/sem-foto-servico.png");
                                            }
                                        } else {
                                            echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/servico/sem-foto-servico.png");
                                        }
                                        ?>" alt="<?php echo htmlspecialchars($servico['alt_foto_servico'],ENT_QUOTES,'UTF-8') ?>">
                        <div class="card-conteudo">
                            <h3><?php echo htmlspecialchars($servico['nome_servico'],ENT_QUOTES,'UTF-8');?></h3>
                            <div class="card-footer">
                                <a href="https://sarafashion.webdevsolutions.com.br/public/contato">CONTRATAR</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-estetica">
                        <img src="assets/img/depilacao.png" alt="Limpeza de Pele">
                        <div class="card-conteudo">
                            <h3>Depilação</h3>
                            <div class="card-footer">
                                <a href="#">CONTRATAR</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-estetica">
                        <img src="assets/img/Massagem.png" alt="Limpeza de Pele">
                        <div class="card-conteudo">
                            <h3>Massagem</h3>
                            <div class="card-footer">
                                <a href="#">CONTRATAR</a>
                            </div>
                        </div>
                    </div> -->
                <?php endforeach?>
            </div>
        </div>
    </div>
</section>