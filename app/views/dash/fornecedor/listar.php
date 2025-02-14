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

<h1>Listar Fornecedor</h1>
<div class="navTool">
    <a href="http://localhost/sarafashion/public/fornecedor/adicionar">ADICIONAR</a>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Jurídico/Físico</th>
            <th scope="col">Cpf/Cnpj</th>
            <th scope="col">Telefone</th>
            <th scope="col">Produto Fornecido</th>
            <th scope="col">Status</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarFornecedor as $linha): ?>
            <tr>
                <td><?php echo $linha['nome_fornecedor'] ?></td>
                <td><?php echo $linha['tipo_fornecedor'] ?></td>
                <td><?php echo $linha['cpf_cnpj_fornecedor'] ?></td>
                <td><?php echo $linha['telefone_fornecedor'] ?></td>
                <td><?php echo $linha['produto_fornecido'] ?></td>
                <td><?php echo $linha['status_fornecedor'] ?></td>
                <td><i id="btn-primary" class="bi bi-pencil"></i></td>
                <td><i id="btn-secundary" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>