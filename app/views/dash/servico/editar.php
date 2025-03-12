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
<h1>Editar Servico</h1>
<!-- Tempus dominus timepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css" crossorigin="anonymous">
<div class="container mt-5">
    <form method="POST" action="http://localhost/sarafashion/public/servico/editar/<?php echo $servico['id_servico']; ?>" enctype="multipart/form-data">
        <div class="img">
            <?php
            $fotoServico = $servico['foto_servico'];
            $fotoPath = "http://localhost/sarafashion/public/uploads/" . $fotoServico;
            $fotoDefault = "http://localhost/sarafashion/public/uploads/servico/sem-foto-servico.png";

            $imagePath = (file_exists($_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $fotoServico) && !empty($fotoServico))
                ? $fotoPath
                : $fotoDefault;
            ?>

            <img id="preview-img" style="width:100%; cursor:pointer;" src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($servico['nome_servico']); ?>">
            <input type="file" name="foto_servico" id="foto_servico" style="display: none;" accept="image/*">
        </div>
        <div class="container-form">
            <!-- Nome do Serviço -->
            <div class="mb-3">
                <label for="nome_servico" class="form-label">Nome do Serviço</label>
                <input type="text" class="form-control" name="nome_servico" value="<?php echo htmlspecialchars($servico['nome_servico']); ?>" id="nome_servico" required>
            </div>

            <!-- Descrição do Serviço -->
            <div class="mb-3">
                <label for="descricaoServico" class="form-label">Descrição do Serviço</label>
                <textarea class="form-control" name="descricao_servico" id="descricaoServico" rows="3" required><?php echo htmlspecialchars($servico['descricao_servico']); ?></textarea>
            </div>

            <div class="flex">
                <div class="mb-3">
                    <label for="precoBase" class="form-label">Preço Base</label>
                    <input type="number" name="preco_base_servico" step="0.5" min='0' value="<?php echo htmlspecialchars($servico['preco_base_servico']); ?>" class="form-control" id="preco_base_servico" required>
                </div>

                <!-- Tempo Estimado -->
                <div class="mb-3">
                    <label for="tempoEstimado" class="form-label">Tempo Estimado</label>
                    <div class="input-group" id="datetimepicker">
                        <input type="text" class="form-control" name="tempo_estimado_servico" placeholder="--:--" value="<?php echo htmlspecialchars($servico['tempo_estimado_servico']); ?>" id="tempoEstimado" />
                        <span class="input-group-text">
                            <i class="fa fa-clock"></i>
                        </span>
                    </div>
                </div>

                <!-- Especialidade -->
                <div class="mb-3">
                    <label for="id_especialidade" class="form-label">Especialidade</label>
                    <select name="id_especialidade" class="form-select" id="id_especialidade" required>
                        <option selected disabled>-- Selecione --</option>
                        <?php foreach ($listarEspecialidade as $especialidades): ?>
                            <option value="<?php echo $especialidades['id_especialidade']; ?>"
                                <?php if ($especialidades['id_especialidade'] == $servico['id_especialidade']) echo 'selected'; ?>>
                                <?php echo $especialidades['nome_especialidade']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Status do Serviço -->
                <div class="mb-3">
                    <label for="statusServico" class="form-label">Status</label>
                    <select class="form-select" id="status_servico" name="status_servico" required>
                        <option selected disabled>Selecione o status</option>
                        <option value="Ativo" <?php echo ($servico['status_servico'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                        <option value="Inativo" <?php echo ($servico['status_servico'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="nome_servico" class="form-label">Se não existir a especialidade desejada, informe no campo a baixo:</label>
                <input type="text" class="form-control" name="nova_especialidade">
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
        const arquivo = document.getElementById('foto_servico');

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