<div class="of-height-125"></div>
<section class="formulario-contato">
    <div class="site">
        <div class="container-contato">
            <div class="titulo">
                <div class="textoFundo">Contact</div>
                <h2>Contate-Nos</h2>
            </div>
            <div class="form-contato">
                <!-- Formulário -->
                <form class="form-inputs" action="<?= BASE_URL?>contato/enviarEmail" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nome_contato" placeholder="Digite seu nome completo" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email_contato" placeholder="Digite seu email" required>
                    </div>

                    <div class="mb-3">
                        <input type="tel" class="form-control" name="telefone_contato" placeholder="Digite seu telefone" required>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="mensagem_contato" rows="4" placeholder="Escreva uma mensagem..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Enviar</button>
                </form>

                <div class="informacao-contato">
                    <div class="informacao-header">
                        <h2>INFORMAÇÕES DE CONTATO</h2>
                    </div>
                    <div class="subinfo">
                        <p>Quer agendar um horário ou tirar dúvidas? Fale com a gente pelos canais abaixo. Estamos prontos para te atender!</p>
                    </div>
                    <div class="informacao-conteudo">
                        <div class="contatoDesc">
                            <div class="contatoIcon">
                                <img src="/assets/img/localizacao.png" alt="">
                            </div>
                            <p>AV. MONSENHOR AGNELO, 628 - VILA PROGRESSO</p>
                        </div>
                        <div class="contatoDesc">
                            <div class="contatoIcon">
                                <img src="/assets/img/fone.png" alt="">
                            </div>
                            <p>(11)98361-2610</p>
                        </div>
                        <div class="contatoDesc">
                            <div class="contatoIcon">
                                <img src="/assets/img/mail.png" alt="">
                            </div>
                            <p>sara_silva1502@hotmail.com</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>