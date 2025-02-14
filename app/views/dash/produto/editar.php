<h1>Adicionar Produto</h1>
<div class="container mt-5">
    <form>
        <!-- Nome do Serviço -->
        <div class="mb-3">
            <label for="nomeServico" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="nomeServico" placeholder="Digite o nome do serviço" required>
        </div>

        <!-- Descrição do Produt -->
        <div class="mb-3">
            <label for="descricaoServico" class="form-label">Descrição do Produto</label>
            <textarea class="form-control" id="descricaoServico" rows="3" placeholder="Digite a descrição" required></textarea>
        </div>

        <!-- Preço Produto -->
        <div class="mb-3">
            <label for="precoBase" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Ex.: 100.00" required>
        </div>

        <!-- Estoque Produto -->
        <div class="mb-3">
            <label for="precoBase" class="form-label">Estoque</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Estoque" required>
        </div>

        <!-- Status do Produto -->
        <div class="mb-3">
            <label for="statusServico" class="form-label">Status</label>
            <select class="form-select" id="statusServico" required>
                <option selected disabled>Selecione o status</option>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
        </div>

        <!-- Foto do Produto -->
        <div class="mb-3">
            <label for="fotoServico" class="form-label">Foto do Produto</label>
            <input type="file" class="form-control" id="fotoServico">
        </div>

        <!-- Botões -->
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
    </form>
</div>