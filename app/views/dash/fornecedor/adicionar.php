<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem']) && isset($_SESSION['tipo-msg']) && $_SESSION['tipo-msg'] == 'erro') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erro!</strong> ' . $_SESSION['mensagem'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo-msg']);
}
?>
<!-- Tempus Dominus Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus/dist/css/tempus-dominus.min.css" crossorigin="anonymous">

<h1>Adicionar Fornecedor</h1>
<div class="container mt-5">
    <form id="normal" method="POST" action="https://sarafashion.webdevsolutions.com.br/public/fornecedor/adicionar">
        <!-- Nome do Fornecedor -->
        <div class="mb-3">
            <label for="nomeFornecedor" class="form-label">Nome do Fornecedor</label>
            <input type="text" class="form-control" id="nomeFornecedor" name="nome_fornecedor" placeholder="Digite o nome do fornecedor" required>
        </div>

        <!-- Tipo do Fornecedor -->
        <div class="mb-3">
            <label for="tipoFornecedor" class="form-label">Tipo Fornecedor</label>
            <select class="form-select" name="tipo_fornecedor" id="tipoFornecedor" required>
                <option selected disabled>Selecione o tipo do fornecedor</option>
                <option value="Pessoa Jurídica">Pessoa Jurídica</option>
                <option value="Pessoa Física">Pessoa Física</option>
            </select>
        </div>

        <!-- CPF/CNPJ -->
        <div class="mb-3">
            <label for="cpfCnpjFornecedor" class="form-label">Documento (CPF/CNPJ)</label>
            <input type="text" name="cpf_cnpj_fornecedor" class="form-control" id="cpfCnpjFornecedor" placeholder="Digite o CPF ou CNPJ" required>
        </div>

        <!-- Data de Cadastro -->
        <div class="mb-3">
            <label for="dataCadastro" class="form-label">Data de Cadastro</label>
            <div class="input-group date" id="dataCadastroPicker">
                <input type="text" class="form-control" name="data_cad_fornecedor" id="dataCadastro" placeholder="DD/MM/YYYY" />
                <span class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </div>

        <!-- Telefone -->
        <div class="mb-3">
            <label for="telefoneFornecedor" class="form-label">Telefone</label>
            <input type="tel" name="telefone_fornecedor" class="form-control" id="telefoneFornecedor" placeholder="Digite o telefone do fornecedor" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="emailFornecedor" class="form-label">Email</label>
            <input type="email" name="email_fornecedor" class="form-control" id="emailFornecedor" placeholder="Digite o email do fornecedor" required>
        </div>

        <!-- Endereço -->
        <div class="mb-3">
            <label for="enderecoFornecedor" class="form-label">Endereço</label>
            <input type="text" name="endereco_fornecedor" class="form-control" id="enderecoFornecedor" placeholder="Digite o endereço do fornecedor" required>
        </div>

        <!-- Cidade -->
        <div class="mb-3">
            <label for="cidadeFornecedor" class="form-label">Cidade</label>
            <input type="text" name="cidade_fornecedor" class="form-control" id="cidadeFornecedor" placeholder="Digite a cidade do fornecedor" required>
        </div>

        <!-- Produto Fornecido -->
        <div class="mb-3">
            <label for="produtoFornecido" class="form-label">Produto Fornecido</label>
            <select class="form-select" name="produto_fornecido" id="produtoFornecido" required>
                <option selected disabled>Selecione o produto fornecido</option>
                <option value="Cabelo">Cabelo</option>
                <option value="Estética">Estética</option>
                <option value="Maquiagem">Maquiagem</option>
            </select>
        </div>

        <!-- Status do Fornecedor -->
        <div class="mb-3">
            <label for="statusFornecedor" class="form-label">Status</label>
            <select class="form-select" name="status_fornecedor" id="statusFornecedor" required>
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
<script src="https://sarafashion.webdevsolutions.com.br/public/assets/js/teste.js"></script>