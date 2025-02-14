<h1>Adicionar Marca</h1>
<div class="container mt-5">
    <form method="POST" action="http://localhost/sarafashion/public/marcas/adicionar" enctype="multipart/form-data">
        <div class="img">
            <img id="preview-img" style="width:100%; cursor:pointer;" title="Clique na imagem para selecionar uma foto de serviço" src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png" alt="">
            <input type="file" name="logo_marca" id="logo_marca" required style="display: none;" accept="image/*">
        </div>
        <div class="container-form">
            <!-- Nome do Serviço -->
            <div class="mb-3">
                <label class="form-label">Nome da Marca</label>
                <input type="text" class="form-control" name="nome_marca" required>
            </div>

            <!-- Status da Marca -->
            <div class="mb-3">
                <label for="statusMarcas" class="form-label">Status</label>
                <select class="form-select" name="status_marcas" required>
                    <option selected disabled>Selecione o status</option>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const visualizarImg = document.getElementById('preview-img');
        const arquivo = document.getElementById('logo_marca');

        visualizarImg.addEventListener('click', function() {
            arquivo.click()
        })

        arquivo.addEventListener('change', function() {
            if (arquivo.files && arquivo.files[0]) {
                let render = new FileReader();
                render.onload = function(e) {
                    visualizarImg.src = e.target.result
                }

                render.readAsDataURL(arquivo.files[0]);

            }

        })
    })
</script>