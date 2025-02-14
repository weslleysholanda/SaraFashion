<section class="login">
    <div class="site">
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="#">
                    <h1>Criar Conta</h1>
                    <span>use seu email para se registrar</span>
                    <input type="text" name="nome" placeholder="Insira Seu Nome" />
                    <input type="email" name="email" placeholder="Insira seu email" />
                    <input type="password" name="senha" placeholder="Insira uma senha" />
                    <button>Cadastrar</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form method="POST" action="http://localhost/sarafashion/public/auth/login">
                    <h1>Entre</h1>
                    <span>Faça login com suas credenciais para continuar sua jornada.</span>
                    <input type="email" name="email" placeholder="Insira seu email" />
                    <input type="password" name="senha" placeholder="Insira sua senha" />
                    <select class="form-select" name="tipo_usuario" id="tipo_usuario" required="">
                        <option selected="">Selecione</option>
                        <option value="Cliente">Cliente</option>
                        <option value="Funcionario">Funcionário</option>
                    </select>
                    <a href="#">Esqueceu a Senha?</a>
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