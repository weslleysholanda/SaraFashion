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
                <form class="form-inputs" action="contato/enviarEmail" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nome" placeholder="Digite seu nome completo" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Digite seu email" required>
                    </div>

                    <div class="mb-3">
                        <input type="tel" class="form-control" name="tel" placeholder="Digite seu telefone" required>
                    </div>

                    <div class="mb-3">
                        <select id="assunto" name="tipoServico" required>
                            <option value="" disabled selected>Escolha o serviço que deseja realizar</option>
                            <option value="alisamento">Alisamento</option>
                            <option value="maquiagem">Maquiagem</option>
                            <option value="corte">Corte</option>
                            <option value="alongamento">Alongamento</option>
                            <option value="limpeza">Limpeza de pele</option>
                            <option value="depilacao">Depilação</option>
                            <option value="massagem">Massagem</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="mensagem" rows="4" placeholder="Escreva uma mensagem..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Enviar</button>
                </form>

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
        </div>
    </div>
</section>