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
            <div class="mensagem-container"></div>
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
                        <span>
                            <?php
                            $data = $cliente['data_nasc_cliente'];

                            if ($data === '0000-00-00' || empty($data)) {
                                echo '00/00/0000';
                            } else {
                                echo date_format(date_create($data), 'd/m/Y');
                            }
                            ?>
                        </span>
                    </div>
                </div>

                <a href="#editar" class="btn-edit" data-id="<?php echo $_SESSION['userId']; ?>" onclick="editarPerfil(event, this)">Editar</a>
            </div>
        </div>
        <div id="editar" class="tab">
            <h2>Editar Dados</h2>
            <form action="<?= BASE_URL ?>perfil/editar" id="form-editar-perfil" method="POST" enctype="multipart/form-data">
                <div class="img">
                    <?php
                    $fotoCliente = $cliente['foto_cliente'] ?? '';
                    $fotoPath = "/uploads/" . $fotoCliente;
                    $fotoDefault = "/assets/img/sem-foto-cliente.png";

                    $caminhoFisico = $_SERVER['DOCUMENT_ROOT'] . $fotoPath;

                    $imagePath = (!empty($fotoCliente) && file_exists($caminhoFisico))
                        ? $fotoPath
                        : $fotoDefault;
                    ?>

                    <img id="preview-img"
                        title="Clique na imagem para selecionar uma foto do funcionário"
                        src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>"
                        alt="Foto do Cliente">

                    <input type="file" name="foto_cliente" id="foto_cliente" style="display: none;" accept="image/*">
                </div>
                <div class="container-form">
                    <div class="flex">
                        <div class="mb-3">
                            <label for="nome_cliente" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome_cliente" required pattern="[A-Za-zÀ-ÿ\s]+" value="<?php echo htmlspecialchars($cliente['nome_cliente']); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="telefone_cliente" class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone_cliente" value="<?php echo htmlspecialchars($cliente['telefone_cliente']); ?>" placeholder="(__) _____-____">
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email_cliente" value="<?php echo htmlspecialchars($cliente['email_cliente']); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" id="senha" class="form-control" name="senha_cliente">
                            <svg xmlns="http://www.w3.org/2000/svg" id="eyeClosed" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="eyeOpen" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" style="display: none;">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-3">
                            <label class="form-label">Tipo Cliente</label>
                            <select class="form-select" name="tipo_cliente">
                                <option selected disabled>Selecione o tipo</option>
                                <option value="Pessoa Jurídica" <?php echo ($cliente['tipo_cliente'] == 'Pessoa Jurídica') ? 'selected' : ''; ?>>Pessoa Jurídica</option>
                                <option value="Pessoa Física" <?php echo ($cliente['tipo_cliente'] == 'Pessoa Física') ? 'selected' : ''; ?>>Pessoa Física</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cpf_cnpj_cliente" class="form-label">CPF/CNPJ</label>
                            <input type="text" class="form-control" name="cpf_cnpj_cliente" value="<?php echo htmlspecialchars($cliente['cpf_cnpj_cliente']); ?>">
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-3">
                            <label for="endereco_cliente" class="form-label">Endereço</label>
                            <input type="text" class="form-control" name="endereco_cliente" value="<?php echo htmlspecialchars($cliente['endereco_cliente']); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="bairro_cliente" class="form-label">Bairro</label>
                            <input type="text" class="form-control" name="bairro_cliente" value="<?php echo htmlspecialchars($cliente['bairro_cliente']); ?>">
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-3">
                            <label for="cidade_cliente" class="form-label">Cidade</label>
                            <input type="text" class="form-control" name="cidade_cliente" value="<?php echo htmlspecialchars($cliente['cidade_cliente']); ?>">
                        </div>

                        <div class="mb-3">
                            <?php
                            $data_banco = $cliente['data_nasc_cliente'] ?? null;
                            $data_formatada = '';

                            if (!empty($data_banco) && $data_banco !== '0000-00-00') {
                                $data_obj = DateTime::createFromFormat('Y-m-d', $data_banco);
                                if ($data_obj) {
                                    $data_formatada = $data_obj->format('d/m/Y');
                                }
                            }
                            ?>
                            <label for="data_nasc_cliente" class="form-label">Data de Nascimento</label>
                            <div class="input-group">

                                <input type="text" id="data_nasc_cliente" class="form-control" name="data_nasc_cliente"
                                    value="<?= htmlspecialchars($data_formatada) ?>" placeholder="dd/mm/aa" autocomplete="off">
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
            <!-- Calendário -->
            <div class="calendar-container">
                <div class="calendar-header">
                    <span id="prev-month-button" style="cursor: pointer; display: none;">
                        <svg width="11" height="22" viewBox="0 0 11 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.9998 2.6037C11.0013 2.67488 10.9912 2.7457 10.9699 2.81182C10.9486 2.878 10.9166 2.93802 10.8759 2.98841L4.40585 10.9969L10.8717 19.0107C10.951 19.109 10.9956 19.2421 10.9956 19.381C10.9956 19.5199 10.951 19.6532 10.8717 19.7514L9.1794 21.8467C9.10005 21.9449 8.99246 22 8.88028 22C8.7681 22 8.66051 21.9448 8.58116 21.8466L0.123906 11.3673C0.0445557 11.269 4.05312e-06 11.1358 4.05349e-06 10.9969C4.05387e-06 10.858 0.0445557 10.7248 0.123906 10.6266L8.58539 0.153361C8.62545 0.103823 8.67316 0.0647169 8.72568 0.0382977C8.7782 0.0118786 8.83446 -0.00114464 8.89112 0C9.00103 0.00217957 9.10593 0.0573404 9.1836 0.153594L10.8759 2.24779C10.9524 2.34251 10.9969 2.4697 10.9998 2.6037Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span id="current-month"></span>
                    <span id="next-month-button" style="cursor: pointer;">
                        <svg width="11" height="22" viewBox="0 0 11 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.000152347 19.3963C-0.00139076 19.3251 0.0088022 19.2543 0.0301092 19.1882C0.0514162 19.122 0.0833898 19.062 0.124077 19.0116L6.59415 11.0031L0.128289 2.98927C0.0489794 2.89103 0.00442616 2.75787 0.00442526 2.61897C0.00442436 2.48007 0.048976 2.34685 0.128284 2.24861L1.8206 0.153339C1.89995 0.055154 2.00754 -3.71229e-06 2.11972 1.87372e-10C2.2319 3.71267e-06 2.33949 0.0552092 2.41884 0.1534L10.8761 10.6327C10.9554 10.731 11 10.8642 11 11.0031C11 11.142 10.9554 11.2752 10.8761 11.3734L2.41461 21.8466C2.37455 21.8962 2.32684 21.9353 2.27432 21.9617C2.2218 21.988 2.16554 22.0011 2.10888 22C1.99897 21.9978 1.89407 21.9427 1.8164 21.8464L0.124109 19.7522C0.0475555 19.6575 0.00314455 19.5303 0.000152347 19.3963Z"
                                fill="white" />
                        </svg>
                    </span>
                </div>
                <div class="calendar-days">
                </div>
            </div>
        </div>
        <div id="sair" class="tab">
            <h2>Sair</h2>
            <p>Deseja realmente sair?</p>

            <a href="<?php echo BASE_URL; ?>/perfil/logout" class="btn-logout">Sair</a>
        </div>
    </div>
</div>