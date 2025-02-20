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
<h1>Editar Funcionário</h1>
<div class="container mt-5">
<form method="POST" action="http://localhost/sarafashion/public/funcionario/editar/<?php echo $servico['id_funcionario']; ?>" enctype="multipart/form-data">
        <div class="img">
            <img id="preview-img" style="width:100%; cursor:pointer;"
                title="Clique na imagem para selecionar uma foto do funcionário"
                src="http://localhost/sarafashion/public/assets/img/sem-foto-produto.png"
                alt="Foto do Funcionário">
            <input type="file" name="foto_funcionario" id="foto_funcionario" style="display: none;" accept="image/*">
        </div>

        <div class="container-form">

            <div class="flex">
                <div class="mb-3">
                    <label for="nome_funcionario" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome_funcionario" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo Cliente</label>
                    <select class="form-select" name="tipo_funcionario" required>
                        <option selected disabled>Selecione o tipo</option>
                        <option value="<?php htmlspecialchars('Pessoa Jurídica', ENT_QUOTES, 'UTF-8') ?>">Pessoa Jurídica</option>
                        <option value="<?php htmlspecialchars('Pessoa Física', ENT_QUOTES, 'UTF-8') ?>">Pessoa Física</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cpf_cnpj_funcionario" class="form-label">CPF/CNPJ</label>
                    <input type="text" class="form-control" name="cpf_cnpj_funcionario" id="cpf_cnpj_funcionario" required>
                </div>
            </div>

            <div class="flex">
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email_funcionario" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha_funcionario" required>
                </div>

                <div class="mb-3">
                    <label for="telefone_funcionario" class="form-label">Telefone</label>
                    <input type="text" class="form-control" name="telefone_funcionario" required>
                </div>
            </div>

            <div class="flex">
                <div class="mb-3">
                    <label for="endereco_funcionario" class="form-label">Endereço</label>
                    <input type="text" class="form-control" name="endereco_funcionario" id="endereco_funcionario" required>
                </div>

                <div class="mb-3">
                    <label for="bairro_funcionario" class="form-label">Bairro</label>
                    <input type="text" class="form-control" name="bairro_funcionario" id="bairro_funcionario" required>
                </div>

                <div class="mb-3">
                    <label for="cidade_funcionario" class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="cidade_funcionario" id="cidade_funcionario" required>
                </div>
            </div>

            <div class="flex">
                <div class="mb-3">
                    <label for="cargo_funcionario" class="form-label">Cargo</label>
                    <input type="text" class="form-control" name="cargo_funcionario" id="cargo_funcionario" required>
                </div>

                <div class="mb-3">
                    <label for="id_especialidade" class="form-label">Especialidade</label>
                    <select name="id_especialidade" class="form-select" id="id_especialidade" required>
                        <option selected disabled>-- Selecione --</option>
                        <?php foreach ($listarEspecialidade as $especialidades): ?>
                            <option value="<?php echo $especialidades['id_especialidade']; ?>">
                                <?php echo $especialidades['nome_especialidade']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="salario_funcionario" class="form-label">Salário</label>
                    <input type="number" name="salario_funcionario" step="anny" class="form-control" id="salario_funcionario" required>
                </div>
            </div>

            <div class="flex">
                <div class="mb-3">
                    <label for="status_funcionario" class="form-label">Status</label>
                    <select class="form-select" id="status_funcionario" name="status_funcionario" required>
                        <option selected disabled>Selecione o status</option>
                        <option value="<?php htmlspecialchars('Ativo', ENT_QUOTES, 'UTF-8') ?>">Ativo</option>
                        <option value="<?php htmlspecialchars('Inativo', ENT_QUOTES, 'UTF-8') ?>">Inativo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dataCadastro" class="form-label">Data de Cadastro</label>
                    <div class="input-group date" id="dataCadastroPicker">
                        <input type="text" class="form-control" name="data_adm_funcionario" id="dataCadastro" placeholder="DD/MM/YYYY" required/>
                        <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Botões -->
            <div class="buttons">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="http://localhost/sarafashion/public/funcionario/listar"><button type="button" class="btn btn-secondary">Cancelar</button></a>
            </div>

        </div>


    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const visualizarImg = document.getElementById('preview-img');
        const arquivo = document.getElementById('foto_funcionario');

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

<!-- Tempus Dominus JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="http://localhost/sarafashion/public/assets/js/teste.js"></script>