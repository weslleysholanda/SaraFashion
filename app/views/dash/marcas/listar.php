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
<h1>Listar Marcas</h1>
<div class="navTool">
    <a href="http://localhost/sarafashion/public/marcas/adicionar">ADICIONAR</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Logo</th>
            <th scope="col">Nome</th>
            <th scope="col">Status</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarMarcas as $linha): ?>
            <tr>
                <td class="imgMarca"><img src="<?php
                                                $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['logo_marca'];
                                                if ($linha['logo_marca'] != "") {
                                                    if (file_exists($caminhoArquivo)) {
                                                        echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($linha['logo_marca'], ENT_QUOTES, 'UTF-8'));
                                                    } else {
                                                        echo ("http://localhost/sarafashion/public/uploads/marca/sem-foto-marca.png");
                                                    }
                                                } else {
                                                    echo ("http://localhost/sarafashion/public/uploads/marca/sem-foto-marca.png");
                                                }
                                                ?>" alt="<?php echo htmlspecialchars($linha['alt_marca'], ENT_QUOTES, 'UTF-8') ?>"></td>
                <td><?php echo $linha['nome_marca'] ?></td>
                <td><?php echo $linha['status_marcas'] ?></td>
                <td><i id="btn-primary" class="bi bi-pencil"></i></td>
                <td><i id="btn-secundary" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>