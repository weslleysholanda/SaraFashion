<h1>Editar Produto</h1>
<div class="container mt-5">
    <form method="POST" action="https://sarafashion.webdevsolutions.com.br/public/produto/editar/<?php echo $produto['id_produto']; ?>" enctype="multipart/form-data">
        <!-- Contêiner das imagens -->
        <div class="product-images">
            <div class="thumbnail-container">
                <?php for ($i = 0; $i < 3; $i++) : ?>
                    <img class="preview-img" data-index="<?= $i ?>"
                        src="<?= !empty($produto['imagens'][$i]) ? 'https://sarafashion.webdevsolutions.com.br/public/uploads/' . htmlspecialchars($produto['imagens'][$i]) : 'https://sarafashion.webdevsolutions.com.br/public/assets/img/sem-foto-produto.png'; ?>">
                <?php endfor; ?>
            </div>

            <div class="main-image">
                <img class="preview-img" data-index="3"
                    src="<?= !empty($produto['imagens'][3]) ? 'https://sarafashion.webdevsolutions.com.br/public/uploads/' . htmlspecialchars($produto['imagens'][3]) : 'https://sarafashion.webdevsolutions.com.br/public/assets/img/sem-foto-produto.png'; ?>">
            </div>
        </div>

        <!-- Inputs para upload de imagem -->
        <?php for ($i = 0; $i < 4; $i++) : ?>
            <input type="file" name="foto_galeria[<?= $i ?>]" class="file-input" data-index="<?= $i ?>" style="display: none;" accept="image/*">
        <?php endfor; ?>

        <!-- Formulário de informações do produto -->
        <div class="container-form">
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" name="nome_produto" value="<?= htmlspecialchars($produto['nome_produto']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="descricao_produto" class="form-label">Descrição do Produto</label>
                <textarea class="form-control" name="descricao_produto" rows="3" required><?= htmlspecialchars($produto['descricao_produto']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="informacao_produto" class="form-label">Informação do Produto</label>
                <textarea class="form-control" name="informacao_produto" rows="3" required><?= htmlspecialchars($produto['informacao_produto']) ?></textarea>
            </div>

            <div class="flex">
                <div class="mb-3">
                    <label for="preco_produto" class="form-label">Preço</label>
                    <input type="number" step="0.01" name="preco_produto" class="form-control" value="<?= htmlspecialchars($produto['preco_produto']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="quantidade_estoque_produto" class="form-label">Estoque</label>
                    <input type="number" step="1" name="quantidade_estoque_produto" class="form-control" value="<?= htmlspecialchars($produto['quantidade_estoque_produto']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="statusServico" class="form-label">Status</label>
                    <select class="form-select" id="status_servico" name="status_produto" required>
                        <option selected disabled>Selecione o status</option>
                        <option value="Ativo" <?= ($produto['status_produto'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                        <option value="Inativo" <?= ($produto['status_produto'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const visualizarImgs = document.querySelectorAll('.preview-img');
        const arquivoInputs = document.querySelectorAll('.file-input');

        visualizarImgs.forEach(img => {
            img.addEventListener('click', function(event) {
                event.preventDefault();
                const index = img.getAttribute('data-index');
                arquivoInputs[index].click();
            });
        });

        arquivoInputs.forEach(input => {
            input.addEventListener('change', function() {
                const index = input.getAttribute('data-index');
                const file = input.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        visualizarImgs[index].src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>