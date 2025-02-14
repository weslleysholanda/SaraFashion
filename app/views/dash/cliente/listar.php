<h1>Listar Cliente</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Jurídico/Físico</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col">Status</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarCliente as $linha): ?>
            <tr>
                <td class="imgBanco"><img src="<?php
                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['foto_cliente'];
                                        if ($linha['foto_cliente'] != "") {
                                            if (file_exists($caminhoArquivo)){
                                                echo ("http://localhost/sarafashion/public/uploads/" .htmlspecialchars($linha['foto_cliente'], ENT_QUOTES, 'UTF-8'));
                                            } else {
                                                echo ("http://localhost/sarafashion/public/uploads/cliente/sem-foto-funcionario.png");
                                            }
                                        } else {
                                            echo ("http://localhost/sarafashion/public/uploads/cliente/sem-foto-funcionario.png");
                                        }
                                        ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_cliente'],ENT_QUOTES,'UTF-8') ?>"></td>
                <td><?php echo $linha['nome_cliente'] ?></td>
                <td><?php echo $linha['tipo_cliente'] ?></td>   
                <td><?php echo $linha['email_cliente'] ?></td>
                <td><?php echo $linha['telefone_cliente'] ?></td>
                <td><?php echo $linha['status_cliente'] ?></td>
                <td><i id="btn-primary" class="bi bi-pencil"></i></td>
                <td><i id="btn-secundary" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>