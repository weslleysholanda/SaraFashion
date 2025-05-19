<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem']) && isset($_SESSION['tipo-msg'])) {
    $mensagem = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipo-msg'];

    /** Exibir a mensagem */
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

    /** Limpar as variáveis de sessão */
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo-msg']);
}
?>

<h1>Listar Marcas</h1>

<!-- Filtros de Status -->
<div class="navTool">
    <div class="filtro">
        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="success-outlined" value="Ativo" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>

        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="danger-outlined" value="Inativo" autocomplete="off">
        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
    </div>
    <div class="navTool-button">
        <a href="https://sarafashion.webdevsolutions.com.br/public/marcas/adicionar">ADICIONAR</a>
    </div>
</div>

<!-- Tabela de Marcas -->
<div class="scroll-tabela">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Logo</th>
                <th scope="col">Nome</th>
                <th scope="col">Status</th>
                <th scope="col">Editar</th>
                <th scope="col" class="acao-coluna">Desativar</th>
            </tr>
        </thead>
        <tbody id="tabela-marcas">
            <?php foreach ($listarMarcas as $linha): ?>
                <tr>
                    <td class="imgMarca">
                        <img src="<?php
                                    $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['logo_marca'];
                                    if ($linha['logo_marca'] != "" && file_exists($caminhoArquivo)) {
                                        echo "https://sarafashion.webdevsolutions.com.br/public/uploads/" . htmlspecialchars($linha['logo_marca'], ENT_QUOTES, 'UTF-8');
                                    } else {
                                        echo "https://sarafashion.webdevsolutions.com.br/public/uploads/marca/sem-foto-marca.png";
                                    }
                                    ?>" alt="<?php echo htmlspecialchars($linha['alt_marca'], ENT_QUOTES, 'UTF-8') ?>">
                    </td>
                    <td><?php echo htmlspecialchars($linha['nome_marca'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($linha['status_marcas'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="https://sarafashion.webdevsolutions.com.br/public/marcas/editar/<?php echo $linha['id_marca']; ?>">
                            <i id="btn-primary" class="bi bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <?php if ($linha['status_marcas'] === 'Ativo'): ?>
                            <i id="btn-secundary" data-id="<?php echo $linha['id_marca']; ?>" onclick="abrirModalDesativarMarca(<?php echo $linha['id_marca']; ?>)" class="bi bi-trash"></i>
                        <?php else: ?>
                            <i id="btn-primary" data-id="<?php echo $linha['id_marca']; ?>" onclick="abrirModalAtivarMarca(<?php echo $linha['id_marca']; ?>)" class="bi bi-check-circle"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal para desativar Marca -->
<div class="modal fade" tabindex="-1" id="modalDesativarMarca">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja desativar essa marca?</p>
                <input type="hidden" id="idMarcaDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Desativar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Ativar Marca -->
<div class="modal fade" tabindex="-1" id="modalAtivarMarca">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ativar Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja ativar essa marca?</p>
                <input type="hidden" id="idMarcaAtivar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Ativar</button>
            </div>
        </div>
    </div>
</div>