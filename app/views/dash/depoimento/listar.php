<h1>Listar Depoimento</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Data</th>
            <th scope="col">avaliacao</th>
            <th scope="col">Status</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarDepoimento as $linha): ?>
            <tr>
                <td class="imgBanco"><img src="<?php
                                                $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['foto_cliente'];
                                                if ($linha['foto_cliente'] != "") {
                                                    if (file_exists($caminhoArquivo)) {
                                                        echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/" . htmlspecialchars($linha['foto_cliente'], ENT_QUOTES, 'UTF-8'));
                                                    } else {
                                                        echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/cliente/sem-foto-funcionario.png");
                                                    }
                                                } else {
                                                    echo ("https://sarafashion.webdevsolutions.com.br/public/uploads/cliente/sem-foto-funcionario.png");
                                                }
                                                ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_cliente'], ENT_QUOTES, 'UTF-8') ?>"></td>
                <td><?php echo $linha['nome_cliente'] ?></td>
                <td><?php echo date_format(date_create($linha['data_avaliacao']), 'd/m/Y H:i'); ?></td>
                <td><?php echo $linha['comentario_avaliacao'] ?></td>
                <td><?php echo $linha['status_avaliacao'] ?></td>
                <td><i id="btn-secundary" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>