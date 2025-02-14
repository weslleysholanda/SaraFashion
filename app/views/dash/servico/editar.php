<div class="container mt-5">
    <h2>Editar Serviço</h2>
    <form>
        <!-- Nome do Serviço -->
        <div class="mb-3">
            <label for="nomeServico" class="form-label">Nome do Serviço</label>
            <input type="text" class="form-control" id="nomeServico" placeholder="Digite o nome do serviço" required>
        </div>

        <!-- Descrição do Serviço -->
        <div class="mb-3">
            <label for="descricaoServico" class="form-label">Descrição do Serviço</label>
            <textarea class="form-control" id="descricaoServico" rows="3" placeholder="Digite a descrição" required></textarea>
        </div>

        <!-- Preço Base do Serviço -->
        <div class="mb-3">
            <label for="precoBase" class="form-label">Preço Base</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Ex.: 100.00" required>
        </div>

        <!-- Tempo Estimado -->
        <div class="mb-3">
            <label for="tempoEstimado" class="form-label">Tempo Estimado</label>
            <div class="input-group" id="datetimepicker">
                <input type="text" class="form-control" id="tempoEstimado" placeholder="HH:MM:SS" />
                <span class="input-group-text">
                    <i class="fa fa-clock"></i>
                </span>
            </div>
        </div>



        <!-- Especialidade -->
        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade</label>
            <select class="form-select" id="especialidade" required>
                <option selected disabled>Selecione a especialidade</option>
                <option value="1">Especialidade 1</option>
                <option value="2">Especialidade 2</option>
                <option value="3">Especialidade 3</option>
            </select>
        </div>

        <!-- Status do Serviço -->
        <div class="mb-3">
            <label for="statusServico" class="form-label">Status</label>
            <select class="form-select" id="statusServico" required>
                <option selected disabled>Selecione o status</option>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
        </div>

        <!-- Foto do Serviço -->
        <div class="mb-3">
            <label for="fotoServico" class="form-label">Foto do Serviço</label>
            <input type="file" class="form-control" id="fotoServico">
        </div>

        <!-- Botões -->
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
    </form>
</div>