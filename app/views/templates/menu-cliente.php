<div class="of-height-100"></div>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <p>Olá, <?php echo htmlspecialchars($_SESSION['userNome']); ?>!</p>
        <a class="active" onclick="changeTab(event, 'dados')">Dados Pessoais</a>
        <a onclick="changeTab(event, 'pedidos')">Pedidos</a>
        <a onclick="changeTab(event, 'favoritos')">Favoritos</a>
        <a onclick="changeTab(event, 'agendamentos')">Agendamentos</a>
        <a onclick="changeTab(event, 'sair')">Sair</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div id="dados" class="tab active">
            <h2>Dados pessoais</h2>
            <div class="container-info-row">
                <div class="info-row">
                    <div class="info-box">
                        <strong>Nome</strong>
                        <span><?php echo htmlspecialchars($cliente['nome_cliente']); ?></span>
                    </div>
                    <div class="info-box">
                        <strong>Email</strong>
                        <span><?php echo htmlspecialchars($cliente['email_cliente']); ?></span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-box">
                        <strong>Endereço</strong>
                        <span><?php echo htmlspecialchars($cliente['endereco_cliente']); ?></span>
                    </div>
                    <div class="info-box">
                        <strong>Bairro</strong>
                        <span><?php echo htmlspecialchars($cliente['bairro_cliente']); ?></span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-box">
                        <strong>CPF</strong>
                        <span><?php echo htmlspecialchars($cliente['cpf_cnpj_cliente']); ?></span>
                    </div>
                    <div class="info-box">
                        <strong>Telefone</strong>
                        <span><?php echo htmlspecialchars($cliente['telefone_cliente']); ?></span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-box">
                        <strong>Data de nascimento</strong>
                        <span><?php echo date_format(date_create($cliente['data_nasc_cliente']), 'd/m/Y'); ?></span>
                    </div>
                </div>

                <a href="#" class="btn-edit" onclick="editarPerfil()">Editar</a>
            </div>
        </div>
        <div id="editar" class="tab">
            <h2>Editar Dados</h2>
            <form action="atualizar_cliente.php" method="POST">
                <div class="img">
                    <img id="preview-img"
                        title="Clique na imagem para selecionar uma foto do funcionário"
                        src="http://localhost/sarafashion/public/assets/img/sem-foto-cliente.png"
                        alt="Foto do Funcionário">
                    <input type="file" name="foto_cliente" id="foto_cliente" style="display: none;" accept="image/*">
                </div>
                <div class="container-form">
                    <div class="flex">
                        <div class="mb-3">
                            <label for="nome_cliente" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome_cliente" value="<?php echo htmlspecialchars($cliente['nome_cliente']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefone_cliente" class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone_cliente" value="<?php echo htmlspecialchars($cliente['telefone_cliente']); ?>" required>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email_cliente" value="<?php echo htmlspecialchars($cliente['email_cliente']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha_cliente">
                        </div>
                    </div>


                    <div class="flex">
                        <div class="mb-3">
                            <label class="form-label">Tipo Cliente</label>
                            <select class="form-select" name="tipo_cliente" required>
                                <option selected disabled>Selecione o tipo</option>
                                <option value="Pessoa Jurídica" <?php echo ($cliente['tipo_cliente'] == 'Pessoa Jurídica') ? 'selected' : ''; ?>>Pessoa Jurídica</option>
                                <option value="Pessoa Física" <?php echo ($cliente['tipo_cliente'] == 'Pessoa Física') ? 'selected' : ''; ?>>Pessoa Física</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cpf_cnpj_cliente" class="form-label">CPF/CNPJ</label>
                            <input type="text" class="form-control" name="cpf_cnpj_cliente" value="<?php echo htmlspecialchars($cliente['cpf_cnpj_cliente']); ?>" required>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3">
                            <label for="endereco_cliente" class="form-label">Endereço</label>
                            <input type="text" class="form-control" name="endereco_cliente" value="<?php echo htmlspecialchars($cliente['endereco_cliente']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="bairro_cliente" class="form-label">Bairro</label>
                            <input type="text" class="form-control" name="bairro_cliente" value="<?php echo htmlspecialchars($cliente['bairro_cliente']); ?>" required>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-3">
                            <label for="cidade_cliente" class="form-label">Cidade</label>
                            <input type="text" class="form-control" name="cidade_cliente" value="<?php echo htmlspecialchars($cliente['cidade_cliente']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="dataCadastro" class="form-label">Data de Cadastro</label>
                            <div class="input-group date" id="dataCadastroPicker">
                                <input type="text" class="form-control" name="data_nasc_cliente" value="<?php echo date_format(date_create($cliente['data_nasc_cliente']), 'd/m/Y'); ?>" required />
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-secondary" onclick="cancelarEdicao()">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="pedidos" class="tab">
            <h2>Pedidos</h2>
            <p>Você ainda não possui pedidos!</p>
        </div>
        <div id="favoritos" class="tab">
            <h2>Favoritos</h2>
            <p>Você ainda não possui nenhum produto favoritado</p>
        </div>
        <div id="agendamentos" class="tab">
            <h2>Agendamentos</h2>
            <p>Seus agendamentos aparecerão aqui.</p>
        </div>
        <div id="sair" class="tab">
            <h2>Sair</h2>
            <p>Deseja realmente sair?</p>

            <a href="<?php echo BASE_URL; ?>/perfil/logout" class="btn-logout">Sair</a>
        </div>
    </div>
</div>