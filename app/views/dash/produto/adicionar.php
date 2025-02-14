<h1>Adicionar Produto</h1>
<div class="container mt-5">
    <form method="POST" action="http://localhost/sarafashion/public/produto/adicionar" enctype="multipart/form-data">
        <!-- Contêiner das imagens -->
        <div class="product-images">
            <div class="thumbnail-container">
                <!-- Miniaturas clicáveis -->
                <img class="preview-img" data-index="0" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png">


                <img class="preview-img" data-index="1" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png">
                <img class="preview-img" data-index="2" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png">
            </div>

            <!-- Imagem principal -->
            <div class="main-image">
                <img class="preview-img" data-index="3" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png" alt="Imagem Principal">

            </div>
        </div>

        <input type="file" name="foto_galeria[]" id="foto_galeria" style="display: none;" accept="image/*" multiple>

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
                    <input type="number" step="anny" name="preco_produto" class="form-control" placeholder="Ex.: 100.00" required>
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
        const arquivo = document.getElementById('foto_galeria');
        let imagensSelecionadas = new Array(4).fill(null); // Array para armazenar as imagens

        visualizarImgs.forEach(img => {
            img.addEventListener('click', function(event) {
                event.preventDefault(); // Evita que o link abra antes de trocar a imagem
                arquivo.setAttribute('data-index', img.getAttribute('data-index'));
                arquivo.click();
            });
        });

        arquivo.addEventListener('change', function() {
            let index = arquivo.getAttribute('data-index');
            let file = arquivo.files[0];

            if (file && index !== null) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    visualizarImgs[index].src = e.target.result;
                    visualizarImgs[index].parentElement.href = e.target.result; // Atualiza o link para o lightbox
                    imagensSelecionadas[index] = file;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<style>
    .product-images {
        display: flex;
        gap: 15px;
        align-items: flex-start;

        .thumbnail-container {
            display: flex;
            flex-direction: column;
            gap: 10px;

            img {
                width: 80px;
                height: 80px;
                cursor: pointer;
                transition: transform 0.2s ease-in-out;

                &:hover {
                    transform: scale(1.1);
                }
            }
        }

        .main-image {
            img {
                width: 450px;
                height: 350px;
                cursor: pointer;
            }
        }
    }
</style>