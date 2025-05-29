<section class="esqueciSenha">
    <div class="site">
        <div class="caixa-recuperar">
            <div class="area-logo">
                <img src="assets/img/logoDark.svg" alt="Logo">
            </div>

            <div id="mensagemErro" style="color: #58151c; background: #f1aeb5; border: 1px solid #f8d7da; padding: 10px; margin-bottom: 10px; display:none;"></div>

            <div class="title">
                <h1>Esqueceu a Senha?</h1>
            </div>

            <div class="subtitle">
                <p>Digite seu Email para enviarmos instruções para redefinir sua senha.</p>
            </div>

            <form id="formRecuperarSenha" action="<?= BASE_URL ?>esqueceuSenha/recuperarSenha" method="POST" class="form-recuperar">
                <div class="form-control">
                    <div class="campo-input">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12">
                            <path id="Caminho_9" data-name="Caminho 9"
                                d="M15.75,64H2.25A2.136,2.136,0,0,0,0,66v8a2.136,2.136,0,0,0,2.25,2h13.5A2.136,2.136,0,0,0,18,74V66A2.136,2.136,0,0,0,15.75,64Zm-3.7,5.337,4.763-3.628a.871.871,0,0,1,.066.291v8a.855.855,0,0,1-.045.2ZM15.75,65a1.156,1.156,0,0,1,.211.038L9,70.342l-6.961-5.3A1.156,1.156,0,0,1,2.25,65ZM1.17,74.2a.845.845,0,0,1-.045-.2V66a.872.872,0,0,1,.066-.291l4.761,3.627Zm1.08.8a1.2,1.2,0,0,1-.321-.058l4.878-4.955,1.827,1.392a.613.613,0,0,0,.732,0l1.827-1.392,4.878,4.955A1.194,1.194,0,0,1,15.75,75Z"
                                transform="translate(0 -64)" fill="#888" />
                        </svg>

                        <input type="email" name="email_cliente" id="email_cliente" placeholder="E-mail: " required />
                    </div>
                </div>
                <button type="submit" class="btn-control">Confirmar</button>
            </form>
        </div>
    </div>
</section>