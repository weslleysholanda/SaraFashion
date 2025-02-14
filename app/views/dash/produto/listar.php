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
<h1>Listar Produto</h1>
<div class="navTool">
    <a href="http://localhost/sarafashion/public/produto/adicionar">ADICIONAR</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Preço</th>
            <th scope="col">Estoque</th>
            <th scope="col">Status</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarProduto as $linha): ?>
            <tr>
                <td class="imgBanco"><img src="<?php
                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['foto_galeria'];
                                        if ($linha['foto_galeria'] != "") {
                                            if (file_exists($caminhoArquivo)){
                                                echo ("http://localhost/sarafashion/public/uploads/" .htmlspecialchars($linha['foto_galeria'], ENT_QUOTES, 'UTF-8'));
                                            } else {
                                                echo ("http://localhost/sarafashion/public/uploads/galeria/sem-foto-produto.png");
                                            }
                                        } else {
                                            echo ("http://localhost/sarafashion/public/uploads/galeria/sem-foto-produto.png");
                                        }
                                        ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_galeria'],ENT_QUOTES,'UTF-8') ?>"></td>
                <td><?php echo $linha['nome_produto'] ?></td>
                <td><?php echo $linha['preco_produto'] ?></td>
                <td><?php echo $linha['quantidade_estoque_produto'] ?></td>
                <td><?php echo $linha['status_produto'] ?></td>
                <td><i id="btn-primary" class="bi bi-pencil"></i></td>
                <td><i id="btn-secundary" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>