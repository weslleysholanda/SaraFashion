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
<h1>Listar Especialidade</h1>
<div class="navTool">
    <div class="filtro">
        <input type="radio" class="btn-check filtro-status-especialidade" name="options-outlined" id="success-outlined" value="Ativo" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>

        <input type="radio" class="btn-check filtro-status-especialidade" name="options-outlined" id="danger-outlined" value="Inativo" autocomplete="off">
        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
    </div>
</div>
<div class="scroll-tabela">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Especialidade</th>
                <th scope="col">Editar</th>
                <th scope="col">Status</th>
                <th scope="col" class="acao-coluna">Desativar</th>
            </tr>
        </thead>
        <tbody id="tabela-especialidade">
            <?php foreach ($listarEspecialidade as $linha): ?>
                <tr>
                    <td><?php echo $linha['nome_especialidade'] ?></td>
                    <td><a href="https://sarafashion.webdevsolutions.com.br/public/especialidade/editar/<?php echo $linha['id_especialidade'] ?>"><i id="btn-primary" class="bi bi-pencil"></i></a></td>
                    <td><?php echo $linha['status_especialidade'] ?></td>
                    <td>
                        <?php if ($linha['status_especialidade'] === 'Ativo'): ?>
                            <i id="btn-secundary" data-id="<?php echo $linha['id_especialidade']; ?>" onclick="abrirModalDesativarEspecialidade(<?php echo $linha['id_especialidade']; ?>)" class="bi bi-trash"></i>
                        <?php else: ?>
                            <i id="btn-primary" data-id="<?php echo $linha['id_especialidade']; ?>" onclick="abrirModalAtivarEspecialidade(<?php echo $linha['id_especialidade']; ?>)" class="bi bi-check-circle"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal para desativar Especialidade -->
<div class="modal fade" tabindex="-1" id="modalDesativarEspecialidade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Especialidade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja desativar essa especialidade?</p>
                <input type="hidden" id="idEspecialidadeDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Desativar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ativar Especialidade -->
<div class="modal fade" tabindex="-1" id="modalAtivarEspecialidade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ativar Especialidade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja Ativar essa especialidade?</p>
                <input type="hidden" id="idEspecialidadeAtivar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Ativar</button>
            </div>
        </div>
    </div>
</div>