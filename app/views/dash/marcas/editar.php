<?php
// Inicia a sessão apenas se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Exibe apenas mensagens de erro
if (!empty($_SESSION['mensagem']) && !empty($_SESSION['tipo-msg']) && $_SESSION['tipo-msg'] === 'erro') {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_SESSION['mensagem'], ENT_QUOTES, 'UTF-8') . '</div>';

    // Remove a mensagem da sessão após exibir
    unset($_SESSION['mensagem'], $_SESSION['tipo-msg']);
}
?>
<h1>Editar Marca</h1>
<div class="container mt-5">
    <form method="POST" action="http://localhost/sarafashion/public/marcas/editar/<?php echo $marca['id_marca']; ?>" enctype="multipart/form-data">
        <div class="imgMarca">
            <?php
            $fotoMarca = $marca['logo_marca'];
            $fotoPath = "http://localhost/sarafashion/public/uploads/" . $fotoMarca;
            $fotoDefault = "http://localhost/sarafashion/public/uploads/marca/sem-foto-marca.png";

            $imagePath = (file_exists($_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $fotoMarca) && !empty($fotoMarca))
                ? $fotoPath
                : $fotoDefault;
            ?>

            <img id="preview-img" style="width:100%; cursor:pointer;" src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($marca['alt_marca']); ?>">
            <input type="file" name="logo_marca" id="logo_marca" style="display: none;" accept="image/*">
        </div>
        <div class="container-form">
            <!-- Nome do Serviço -->
            <div class="mb-3">
                <label class="form-label">Nome da Marca</label>
                <input type="text" class="form-control" name="nome_marca"value="<?php echo htmlspecialchars($marca['nome_marca']); ?>" required>
            </div>

            <!-- Status da Marca -->
            <div class="mb-3">
                <label for="statusMarcas" class="form-label">Status</label>
                <select class="form-select" id="status_marcas" name="status_marcas" required>
                    <option selected disabled>Selecione o status</option>
                    <option value="Ativo" <?php echo ($marca['status_marcas'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Inativo" <?php echo ($marca['status_marcas'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
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