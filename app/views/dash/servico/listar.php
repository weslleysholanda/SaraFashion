<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem']) && isset($_SESSION['tipo-msg'])) {

    $mensagem = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipo-msg'];

    /**Exibir a mensagem */
    if ($tipo == 'sucesso') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> ' . $mensagem . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } elseif ($tipo == 'erro') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> ' . $mensagem . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    /** Limpe as variáveis de sessão */
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo-msg']);
}


?>
<h1>LISTAR SERVIÇO</h1>
<div class="navTool">
    <a href="http://localhost/sarafashion/public/servico/adicionar">ADICIONAR</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col">Preço</th>
            <th scope="col">Tempo</th>
            <th scope="col">Especialidade</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarServico as $linha): ?>
            <tr>
                <td class="imgBanco"><img src="<?php
                                                $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['foto_servico'];
                                                if ($linha['foto_servico'] != "") {
                                                    if (file_exists($caminhoArquivo)) {
                                                        echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($linha['foto_servico'], ENT_QUOTES, 'UTF-8'));
                                                    } else {
                                                        echo ("http://localhost/sarafashion/public/uploads/servico/sem-foto-servico.png");
                                                    }
                                                } else {
                                                    echo ("http://localhost/sarafashion/public/uploads/servico/sem-foto-servico.png");
                                                }
                                                ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_servico'], ENT_QUOTES, 'UTF-8') ?>"></td>
                <td><?php echo $linha['nome_servico'] ?></td>
                <td><?php echo $linha['descricao_servico'] ?></td>
                <td><?php echo $linha['preco_base_servico'] ?></td>
                <td><?php echo $linha['tempo_estimado_servico'] ?></td>
                <td><?php echo $linha['nome_especialidade'] ?></td>
                <td id="text-center"><i id="btn-primary" class="bi bi-pencil"></i></td>
                <td id="text-center"><i id="btn-secundary" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>