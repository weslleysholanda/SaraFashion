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
    <div class="filtro">
        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="success-outlined" value="Ativo" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>

        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="danger-outlined" value="Inativo" autocomplete="off">
        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
    </div>
    <div class="navTool-button">
        <a href="http://localhost/sarafashion/public/fornecedor/adicionar">ADICIONAR</a>
    </div>
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
                <td id="text-center"><a href="http://localhost/sarafashion/public/fornecedor/editar/<?php echo $linha['id_fornecedor'] ?>"><i id="btn-primary" class="bi bi-pencil"></i></a></td>
                <td><i id="btn-secundary" onclick="abrirModalDesativarFornecedor(<?php echo $linha['id_fornecedor']; ?>)" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div class="modal faded" tabindex="-1" id="modalDesativarFornecedor">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Fornecedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja desativar esse fornecedor?</p>
                <input type="hidden" id="idFornecedorDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Desativar</button>
            </div>
        </div>
    </div>
</div>