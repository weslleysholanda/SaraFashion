<h1>Adicionar Produto</h1>
<div class="container mt-5">
    <form method="POST" action="http://localhost/sarafashion/public/produto/adicionar" enctype="multipart/form-data">
        <!-- Contêiner das imagens -->
        <div class="product-images">
            <div class="thumbnail-container">
                <img class="preview-img" data-index="0" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png">
                <img class="preview-img" data-index="1" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png">
                <img class="preview-img" data-index="2" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png">
            </div>

            <div class="main-image">
                <img class="preview-img" data-index="3" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png">
            </div>
        </div>

        <!-- Input file individual para cada imagem -->
        <input type="file" name="foto_galeria[0]" class="file-input" data-index="0" style="display: none;" accept="image/*">
        <input type="file" name="foto_galeria[1]" class="file-input" data-index="1" style="display: none;" accept="image/*">
        <input type="file" name="foto_galeria[2]" class="file-input" data-index="2" style="display: none;" accept="image/*">
        <input type="file" name="foto_galeria[3]" class="file-input" data-index="3" style="display: none;" accept="image/*">

        <!-- Formulário de informações do produto -->
        <div class="container-form">
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" name="nome_produto" placeholder="Digite o nome do produto" required>
            </div>

            <div class="mb-3">
                <label for="descricao_produto" class="form-label">Descrição do Produto</label>
                <textarea class="form-control" name="descricao_produto" rows="3" placeholder="Digite a descrição" required style="resize: none;"></textarea>
            </div>

            <div class="mb-3">
                <label for="informacao_produto" class="form-label">Informação do Produto</label>
                <textarea class="form-control" name="informacao_produto" rows="3" placeholder="Digite a descrição" required style="resize: none;"></textarea>
            </div>

            <div class="flex">
                <div class="mb-3">
                    <label for="preco_produto" class="form-label">Preço</label>
                    <input type="number" step="0.01" name="preco_produto" class="form-control" placeholder="Ex.: 100.00" required>
                </div>

                <div class="mb-3">
                    <label for="quantidade_estoque_produto" class="form-label">Estoque</label>
                    <input type="number" step="1" name="quantidade_estoque_produto" class="form-control" placeholder="Quantidade" required>
                </div>

                <div class="mb-3">
                    <label for="status_produto" class="form-label">Status</label>
                    <select class="form-select" name="status_produto" required>
                        <option selected disabled>Selecione o status</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
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