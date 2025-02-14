<!-- Tempus Dominus Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus/dist/css/tempus-dominus.min.css" crossorigin="anonymous">
<h1>Editar Funcionario</h1>
<div class="container mt-5">
    <form>
        <!-- Nome do Funcionário -->
        <div class="mb-3">
            <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
            <input type="text" class="form-control" id="nomeFuncionario" placeholder="Digite o nome do funcionário" required>
        </div>

        <!-- Tipo de Fornecedor -->
        <div class="mb-3">
            <label for="tipoFornecedor" class="form-label">Tipo Funcionário</label>
            <select class="form-select" id="tipoFornecedor" required>
                <option selected disabled>Selecione o tipo do funcionário</option>
                <option value="1">Pessoa Jurídica</option>
                <option value="2">Pessoa Física</option>
            </select>
        </div>

        <!-- Documento -->
        <div class="mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input type="text" class="form-control" id="documento" placeholder="Digite o documento" required>
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

        <!-- Telefone -->
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" placeholder="Digite o Telefone do Funcionário" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Digite o Email do Funcionário" required>
        </div>

        <!-- Endereço -->
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" placeholder="Digite o Endereço do Funcionário" required>
        </div>

        <!-- Cidade -->
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" placeholder="Digite a Cidade do Funcionário" required>
        </div>

        <!-- Foto do Funcionário -->
        <div class="mb-3">
            <label for="fotoFuncionario" class="form-label">Foto do Funcionário</label>
            <input type="file" class="form-control" id="fotoFuncionario">
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="statusFuncionario" class="form-label">Status</label>
            <select class="form-select" id="statusFuncionario" required>
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