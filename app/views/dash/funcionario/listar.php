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
<h1>Listar Funcionario</h1>
<div class="navTool">
    <div class="filtro">
        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="success-outlined" value="Ativo" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>

        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="danger-outlined" value="Inativo" autocomplete="off">
        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
    </div>
    <div class="navTool-button">
        <a href="http://localhost/sarafashion/public/funcionario/adicionar">ADICIONAR</a>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Jurídico/Físico</th>
            <th scope="col">Cpf/Cnpj</th>
            <th scope="col">Cadastro</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col">Especialidade</th>
            <th scope="col">Salário</th>
            <th scope="col">Status</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarFuncionario as $linha): ?>
            <tr>
                <td class="imgBanco"><img src="<?php
                                                $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['foto_funcionario'];
                                                if ($linha['foto_funcionario'] != "") {
                                                    if (file_exists($caminhoArquivo)) {
                                                        echo ("http://localhost/sarafashion/public/uploads/" . htmlspecialchars($linha['foto_funcionario'], ENT_QUOTES, 'UTF-8'));
                                                    } else {
                                                        echo ("http://localhost/sarafashion/public/uploads/funcionario/sem-foto-funcionario.png");
                                                    }
                                                } else {
                                                    echo ("http://localhost/sarafashion/public/uploads/funcionario/sem-foto-funcionario.png");
                                                }
                                                ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_funcionario'], ENT_QUOTES, 'UTF-8') ?>"></td>
                <td><?php echo $linha['nome_funcionario'] ?></td>
                <td><?php echo $linha['tipo_funcionario'] ?></td>
                <td><?php echo $linha['cpf_cnpj_funcionario'] ?></td>
                <td><?php echo date_format(date_create($linha['data_adm_funcionario']), 'd/m/Y'); ?></td>
                <td><?php echo $linha['email_funcionario'] ?></td>
                <td><?php echo $linha['telefone_funcionario'] ?></td>
                <td><?php echo $linha['nome_especialidade'] ?></td>
                <td><?php echo $linha['salario_funcionario'] ?></td>
                <td><?php echo $linha['status_funcionario'] ?></td>
                <td id="text-center"><a href="http://localhost/sarafashion/public/funcionario/editar/<?php echo $linha['id_funcionario'] ?>"><i id="btn-primary" class="bi bi-pencil"></i></a></td>
                <td id="text-center"><i id="btn-secundary" onclick="abrirModalDesativarFuncionario(<?php echo $linha['id_funcionario']; ?>)"class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div class="modal faded" tabindex="-1" id="modalDesativarFuncionario">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja desativar esse funcionário?</p>
                <input type="hidden" id="idFuncionarioDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Desativar</button>
            </div>
        </div>
    </div>
</div>