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
    <div class="filtro">
        <input type="radio" class="btn-check filtro-status-servico" name="options-outlined" id="success-outlined" value="Ativo" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>

        <input type="radio" class="btn-check filtro-status-servico" name="options-outlined" id="danger-outlined" value="Inativo" autocomplete="off">
        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
    </div>
    <div class="navTool-button">
        <a href="/servico/adicionar">ADICIONAR</a>
    </div>
</div>
<div class="scroll-tabela">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Foto</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Preço</th>
                <th scope="col">Tempo</th>
                <th scope="col">Especialidade</th>
                <th scope="col">Status</th>
                <th scope="col">Editar</th>
                <th scope="col" class="acao-coluna">Desativar</th>
            </tr>
        </thead>
        <tbody id="tabela-servico">
            <?php foreach ($listarServico as $linha): ?>
                <tr>
                    <td class="imgBanco"><img src="<?php
                                                    $caminhoArquivo = BASE_URL  . "uploads/" . $linha['foto_servico'];
                                                    if ($linha['foto_servico'] != "") {
                                                        if (file_exists($caminhoArquivo)) {
                                                            echo (BASE_URL . "uploads/" . htmlspecialchars($linha['foto_servico'], ENT_QUOTES, 'UTF-8'));
                                                        } else {
                                                            echo (BASE_URL . "uploads/servico/sem-foto-servico.png");
                                                        }
                                                    } else {
                                                        echo (BASE_URL . "uploads/servico/sem-foto-servico.png");
                                                    }
                                                    ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_servico'], ENT_QUOTES, 'UTF-8') ?>"></td>
                    <td><?php echo $linha['nome_servico'] ?></td>
                    <td><?php echo $linha['descricao_servico'] ?></td>
                    <td><?php echo $linha['preco_base_servico'] ?></td>
                    <td><?php echo $linha['tempo_estimado_servico'] ?></td>
                    <td><?php echo $linha['nome_especialidade'] ?></td>
                    <td><?php echo $linha['status_servico'] ?></td>
                    <td><a href="/servico/editar/<?php echo $linha['id_servico'] ?>"><i id="btn-primary" class="bi bi-pencil"></i></a></td>
                    <td>
                        <?php if ($linha['status_servico'] === 'Ativo'): ?>
                            <i id="btn-secundary" data-id="<?php echo $linha['id_servico']; ?>" onclick="abrirModalDesativar(<?php echo $linha['id_servico']; ?>)" class="bi bi-trash"></i>
                        <?php else: ?>
                            <i id="btn-primary" data-id="<?php echo $linha['id_servico']; ?>" onclick="abrirModalAtivarServico(<?php echo $linha['id_servico']; ?>)" class="bi bi-check-circle"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal desativar servico -->
<div class="modal faded" tabindex="-1" id="modalDesativar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Serviços</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja desativar esse serviço?</p>
                <input type="hidden" id="idServicoDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Desativar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal ativar servico -->
<div class="modal faded" tabindex="-1" id="modalAtivar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ativar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja ativar esse serviço?</p>
                <input type="hidden" id="idServicoAtivar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Ativar</button>
            </div>
        </div>
    </div>
</div>