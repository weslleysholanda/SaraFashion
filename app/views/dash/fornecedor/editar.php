<h1>Editar Fornecedor</h1>
<div class="container mt-5">
    <form id="normal" method="POST" action="https://sarafashion.webdevsolutions.com.br/public/fornecedor/editar/<?php echo $fornecedor['id_fornecedor']; ?>">
        <!-- Nome do Fornecedor -->
        <div class="mb-3">
            <label for="nomeFornecedor" class="form-label">Nome do Fornecedor</label>
            <input type="text" class="form-control" id="nomeFornecedor" name="nome_fornecedor" value="<?php echo htmlspecialchars($fornecedor['nome_fornecedor']); ?>" required>
        </div>

        <!-- Tipo do Fornecedor -->
        <div class="mb-3">
            <label class="form-label">Tipo Fornecedor</label>
            <select class="form-select" name="tipo_fornecedor" required>
                <option selected disabled>Selecione o tipo</option>
                <option value="Pessoa Jurídica" <?php echo ($fornecedor['tipo_fornecedor'] == 'Pessoa Jurídica') ? 'selected' : ''; ?>>Pessoa Jurídica</option>
                <option value="Pessoa Física" <?php echo ($fornecedor['tipo_fornecedor'] == 'Pessoa Física') ? 'selected' : ''; ?>>Pessoa Física</option>
            </select>
        </div>

        <!-- CPF/CNPJ -->
        <div class="mb-3">
            <label for="cpfCnpjFornecedor" class="form-label">Documento (CPF/CNPJ)</label>
            <input type="text" name="cpf_cnpj_fornecedor" class="form-control" value="<?php echo htmlspecialchars($fornecedor['cpf_cnpj_fornecedor']); ?>" id="cpfCnpjFornecedor" placeholder="Digite o CPF ou CNPJ" required>
        </div>

        <!-- Data de Cadastro -->
        <div class="mb-3">
            <label for="dataCadastro" class="form-label">Data de Cadastro</label>
            <div class="input-group date" id="dataCadastroPicker">
                <input type="text" class="form-control" name="data_cad_fornecedor" id="dataCadastro" placeholder="DD/MM/YYYY" value="<?php echo date_format(date_create($fornecedor['data_cad_fornecedor']), 'd/m/Y'); ?>" />
                <span class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </span>
            </div>
        </div>

        <!-- Telefone -->
        <div class="mb-3">
            <label for="telefoneFornecedor" class="form-label">Telefone</label>
            <input type="tel" name="telefone_fornecedor" class="form-control" id="telefoneFornecedor" value="<?php echo htmlspecialchars($fornecedor['telefone_fornecedor']); ?>" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="emailFornecedor" class="form-label">Email</label>
            <input type="email" name="email_fornecedor" class="form-control" id="emailFornecedor" value="<?php echo htmlspecialchars($fornecedor['email_fornecedor']); ?>" required>
        </div>

        <!-- Endereço -->
        <div class="mb-3">
            <label for="enderecoFornecedor" class="form-label">Endereço</label>
            <input type="text" name="endereco_fornecedor" class="form-control" id="enderecoFornecedor" value="<?php echo htmlspecialchars($fornecedor['endereco_fornecedor']); ?>" required>
        </div>

        <!-- Cidade -->
        <div class="mb-3">
            <label for="cidadeFornecedor" class="form-label">Cidade</label>
            <input type="text" name="cidade_fornecedor" class="form-control" id="cidadeFornecedor" value="<?php echo htmlspecialchars($fornecedor['cidade_fornecedor']); ?>" required>
        </div>

        <!-- Produto Fornecido -->
        <div class="mb-3">
            <label for="produtoFornecido" class="form-label">Produto Fornecido</label>
            <select class="form-select" name="produto_fornecido" id="produtoFornecido" required>
                <option disabled>Selecione o produto fornecido</option>
                <option value="Cabelo" <?php echo ($fornecedor['produto_fornecido'] == 'Cabelo') ? 'selected' : ''; ?>>Cabelo</option>
                <option value="Estética" <?php echo ($fornecedor['produto_fornecido'] == 'Estética') ? 'selected' : ''; ?>>Estética</option>
                <option value="Maquiagem" <?php echo ($fornecedor['produto_fornecido'] == 'Maquiagem') ? 'selected' : ''; ?>>Maquiagem</option>
            </select>
        </div>

        <!-- Status do Fornecedor -->
        <div class="mb-3">
            <label for="statusFornecedor" class="form-label">Status</label>
            <select class="form-select" name="status_fornecedor" id="statusFornecedor" required>
                <option disabled>Selecione o status</option>
                <option value="Ativo" <?php echo ($fornecedor['status_fornecedor'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                <option value="Inativo" <?php echo ($fornecedor['status_fornecedor'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
            </select>
        </div>

        <!-- Botões -->
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
    </form>
</div>