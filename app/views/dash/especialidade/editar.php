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
<h1>Editar Especialidade</h1>
<div class="container mt-5">
    <form method="POST" action="http://localhost/sarafashion/public/especialidade/editar/<?php echo $especialidade['id_especialidade']; ?>">
        <div class="container-form">
            <!-- Nome do Serviço -->
            <div class="mb-3">
                <label class="form-label">Nome da Especialidade</label>
                <input type="text" class="form-control" name="nome_especialidade"value="<?php echo htmlspecialchars($especialidade['nome_especialidade']); ?>" required>
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
        </div>
    </form>
</div>