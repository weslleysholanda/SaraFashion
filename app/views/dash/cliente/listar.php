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
<h1>Listar Cliente</h1>
<div class="navTool">
    <div class="filtro">
        <input type="radio" class="btn-check filtro-status-cliente" name="options-outlined" id="success-outlined" value="Ativo" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>

        <input type="radio" class="btn-check filtro-status-cliente" name="options-outlined" id="danger-outlined" value="Inativo" autocomplete="off">
        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
    </div>
    <div class="navTool-button">
        <a href="/cliente/adicionar">ADICIONAR</a>
    </div>
</div>
<div class="scroll-tabela">
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
                <th scope="col" class="acao-coluna">Desativar</th>
            </tr>
        </thead>
        <tbody id="tabela-cliente">
            <?php foreach ($listarCliente as $linha): ?>
                <tr>
                    <td class="imgBanco"><img src="<?php
                                                    $caminhoArquivo = BASE_URL  . "uploads/" . $linha['foto_cliente'];
                                                    if ($linha['foto_cliente'] != "") {
                                                        if (file_exists($caminhoArquivo)) {
                                                            echo (BASE_URL . "uploads/" . htmlspecialchars($linha['foto_cliente'], ENT_QUOTES, 'UTF-8'));
                                                        } else {
                                                            echo (BASE_URL . "uploads/cliente/sem-foto-cliente.png");
                                                        }
                                                    } else {
                                                        echo (BASE_URL . "uploads/cliente/sem-foto-cliente.png");
                                                    }
                                                    ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_cliente'], ENT_QUOTES, 'UTF-8') ?>"></td>
                    <td><?php echo $linha['nome_cliente'] ?></td>
                    <td><?php echo $linha['tipo_cliente'] ?></td>
                    <td><?php echo $linha['email_cliente'] ?></td>
                    <td><?php echo $linha['telefone_cliente'] ?></td>
                    <td><?php echo $linha['status_cliente'] ?></td>
                    <td id="text-center"><a href="/cliente/editar/<?php echo $linha['id_cliente'] ?>"><i id="btn-primary" class="bi bi-pencil"></i></a></td>
                    <td>
                        <?php if ($linha['status_cliente'] === 'Ativo'): ?>
                            <i id="btn-secundary" data-id="<?php echo $linha['id_cliente']; ?>" onclick="abrirModalDesativarCliente(<?php echo $linha['id_cliente']; ?>)" class="bi bi-trash"></i>
                        <?php else: ?>
                            <i id="btn-primary" data-id="<?php echo $linha['id_cliente']; ?>" onclick="abrirModalAtivarCliente(<?php echo $linha['id_cliente']; ?>)" class="bi bi-check-circle"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<div class="modal faded" tabindex="-1" id="modalDesativarCliente">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Clientes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja desativar esse cliente?</p>
                <input type="hidden" id="idClienteDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Desativar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal faded" tabindex="-1" id="modalAtivarCliente">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ativar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja ativar esse cliente?</p>
                <input type="hidden" id="idClienteAtivar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Ativar</button>
            </div>
        </div>
    </div>
</div>