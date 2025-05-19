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

<h1>Listar Produto</h1>
<div class="navTool">
    <div class="filtro">
        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="success-outlined" value="Ativo" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="success-outlined">Ativo</label>

        <input type="radio" class="btn-check filtro-status" name="options-outlined" id="danger-outlined" value="Inativo" autocomplete="off">
        <label class="btn btn-outline-danger" for="danger-outlined">Inativo</label>
    </div>
    <div class="navTool-button">
        <a href="https://sarafashion.webdevsolutions.com.br/public/produto/adicionar">ADICIONAR</a>
    </div>
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
                <td class="imgBanco">
                    <?php
                    // Separar as imagens armazenadas no banco
                    $imagens = explode(',', $linha['imagens']);

                    if (isset($imagens[3])) {
                        $imagemPrincipal = $imagens[3];
                        unset($imagens[3]);
                        array_unshift($imagens, $imagemPrincipal);
                    } else {
                        $imagemPrincipal = $imagens[0] ?? 'galeria/sem-foto-produto.png';
                    }
                    ?>

                    <!-- Exibir a imagem principal e ativar o Lightbox -->
                    <a href="https://sarafashion.webdevsolutions.com.br/public/uploads/<?php echo htmlspecialchars($imagemPrincipal, ENT_QUOTES, 'UTF-8'); ?>"
                        data-lightbox="produto-<?php echo $linha['id_produto']; ?>">
                        <img src="https://sarafashion.webdevsolutions.com.br/public/uploads/<?php echo htmlspecialchars($imagemPrincipal, ENT_QUOTES, 'UTF-8'); ?>"
                            width="50">
                    </a>

                    <!-- Adicionar as outras imagens ocultas para Lightbox -->
                    <?php foreach ($imagens as $index => $imagem): ?>
                        <?php if ($index > 0): ?>
                            <a href="https://sarafashion.webdevsolutions.com.br/public/uploads/<?php echo htmlspecialchars($imagem, ENT_QUOTES, 'UTF-8'); ?>"
                                data-lightbox="produto-<?php echo $linha['id_produto']; ?>"
                                style="display: none;"></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>

                <td><?php echo htmlspecialchars($linha['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo number_format($linha['preco_produto'], 2, ',', '.'); ?></td>
                <td><?php echo $linha['quantidade_estoque_produto']; ?></td>
                <td><?php echo $linha['status_produto']; ?></td>
                <td><a href="https://sarafashion.webdevsolutions.com.br/public/produto/editar/<?php echo $linha['id_produto'] ?>"><i id="btn-primary" class="bi bi-pencil"></i></a></td>
                <td id="text-center"><i id="btn-secundary" onclick="abrirModalDesativarProduto(<?php echo $linha['id_produto']; ?>)" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal faded" tabindex="-1" id="modalDesativarProduto">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Produtos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja desativar esse produto?</p>
                <input type="hidden" id="idProdutoDesativar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Desativar</button>
            </div>
        </div>
    </div>
</div>