<section class="login">
    <div class="site">
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="POST" action="<?= BASE_URL?>auth/cadastrar">
                    <?php if (isset($_SESSION['cadastro-erro'])) : ?>
                        <div style="color: #58151c; background: #f1aeb5; border: 1px solid #f8d7da; padding: 10px; margin-bottom: 10px;">
                            <?= $_SESSION['cadastro-erro'];
                            unset($_SESSION['cadastro-erro']); ?>
                        </div>
                    <?php endif; ?>
                    <h1>Criar Conta</h1>
                    <span>Use seu email para se registrar</span>
                    <input type="text" name="nome" placeholder="Insira Seu Nome" required />
                    <input type="email" name="email" placeholder="Insira seu email" required />
                    <input type="password" name="senha" placeholder="Insira uma senha" required />
                    <button>Cadastrar</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form method="POST" action="/auth/login">
                    <h1>Entre</h1>
                    <span>Faça login com suas credenciais para continuar sua jornada.</span>

                    <?php if (isset($_SESSION['login-erro'])) : ?>
                        <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                            <?= $_SESSION['login-erro'];
                            unset($_SESSION['login-erro']); ?>
                        </div>
                    <?php endif; ?>

                    <input type="email" name="email" placeholder="Insira seu email" required />
                    <input type="password" name="senha" placeholder="Insira sua senha" required />
                    <a href="/esqueceuSenha">Esqueceu a Senha?</a>
                    <button>Entrar</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Bem-vindo de volta!</h1>
                        <p>Mantenha-se conectado conosco fazendo login com suas informações pessoais.</p>
                        <button class="ghost" id="signIn">Entrar</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Junte-se a nós</h1>
                        <p>Crie uma conta para aproveitar todos os benefícios que oferecemos.</p>
                        <button class="ghost" id="signUp">CADASTRE-SE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>