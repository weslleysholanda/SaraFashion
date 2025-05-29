<section class="secao-recuperar">
    <div class="site">
        <div class="caixa-recuperar">
            <div class="area-logo">
                <img src="assets/img/logoDark.svg" alt="Logo">
            </div>

            <div class="title">
                <h1>Definir uma nova senha</h1>
            </div>

            <div class="subtitle">
                <p>Deve ter pelo menos 8 caracteres.</p>
            </div>

            <form method="POST" action="<?= BASE_URL ?>recuperarSenha/resetarSenha" class="form-recuperar">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">

                <div class="form-control">
                    <div class="campo-input">
                        <input type="password" name="nova_senha" placeholder="Nova Senha: " id="senha" />
                    </div>

                    <div class="container_password">
                        <div class="forca-senha">
                            <span></span><span></span><span></span><span></span>
                        </div>
                        <div class="erro-senha" id="erro-senha"></div>
                    </div>
                </div>

                <div class="campo-input">
                    <input type="password" placeholder="Confirmar senha" id="senha2" name="confirmar_senha" />
                </div>

                <div class="erro-senha" id="erro-confirmacao"></div>

                <button type="submit" class="btn-control" id="btn-submit" disabled>Confirmar</button>
            </form>
        </div>
    </div>
</section>
