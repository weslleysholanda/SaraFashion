<!-- Tempus Dominus Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus/dist/css/tempus-dominus.min.css" crossorigin="anonymous">
<h1>Editar Fornecedor</h1>
<div class="container mt-5">
    <form>
        <!-- Nome do Serviço -->
        <div class="mb-3">
            <label for="nomeServico" class="form-label">Nome do Fornecedor</label>
            <input type="text" class="form-control" id="nomeServico" placeholder="Digite o nome do fornecedor" required>
        </div>

        <!-- Descrição do Serviço -->
        <div class="mb-3">
            <label for="especialidade" class="form-label">Tipo Fornecedor</label>
            <select class="form-select" id="especialidade" required>
                <option selected disabled>Selecione o tipo do fornecedor</option>
                <option value="1">Pessoa Jurídica</option>
                <option value="2">Pessoa Física</option>
            </select>
        </div>

        <!-- Preço Base do Serviço -->
        <div class="mb-3">
            <label for="precoBase" class="form-label">Documento</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Ex.: 100.00" required>
        </div>

        <!-- Data de Cadastro -->
        <div class="mb-3">
            <label for="dataCadastro" class="form-label">Data de Cadastro</label>
            <div class="input-group date" id="dataCadastroPicker">
                <input type="text" class="form-control" id="dataCadastro" placeholder="DD/MM/YYYY" />
                <span class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="precoBase" class="form-label">Telefone</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Digite o Telefone do Fornecedor" required>
        </div>

        <div class="mb-3">
            <label for="precoBase" class="form-label">Email</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Digite o Email do Fornecedor" required>
        </div>
        
        <div class="mb-3">
            <label for="precoBase" class="form-label">Endereço</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Digite o Endereço do Fornecedor" required>
        </div>
        
        <div class="mb-3">
            <label for="precoBase" class="form-label">Cidade</label>
            <input type="number" step="0.01" class="form-control" id="precoBase" placeholder="Digite a cidade do Fornecedor" required>
        </div>
        
        <div class="mb-3">
            <label for="especialidade" class="form-label">Produto Fornecido</label>
            <select class="form-select" id="especialidade" required>
                <option selected disabled>Selecione o produto fornecido</option>
                <option value="1">Cabelo</option>
                <option value="2">Estética</option>
                <option value="3">Maquiagem</option>
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

        <!-- Botões -->
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
    </form>
</div>
<!-- Tempus Dominus JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="http://localhost/sarafashion/public/assets/js/teste.js"></script>