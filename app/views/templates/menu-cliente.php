<div class="of-height-100"></div>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <p>Olá, usuário!</p>
        <a class="active" onclick="changeTab(event, 'dados')">Dados Pessoais</a>
        <a onclick="changeTab(event, 'pedidos')">Pedidos</a>
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
                        <span>Weslley</span>
                    </div>
                    <div class="info-box">
                        <strong>Email</strong>
                        <span>weslleyh98@gmail.com</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-box">
                        <strong>Endereço</strong>
                        <span>Rua Exemplo, 123</span>
                    </div>
                    <div class="info-box">
                        <strong>Bairro</strong>
                        <span>Centro</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-box">
                        <strong>CPF</strong>
                        <span>000.000.000-00</span>
                    </div>
                    <div class="info-box">
                        <strong>Telefone</strong>
                        <span>(11) 99999-9999</span>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-box">
                        <strong>Data de nascimento</strong>
                        <span>01/01/1990</span>
                    </div>
                </div>

                <a href="#" class="btn-edit">Editar</a>
            </div>
        </div>
        <div id="pedidos" class="tab">
            <h2>Pedidos</h2>
            <p>Você ainda não possui pedidos!</p>
        </div>
        <div id="agendamentos" class="tab">
            <h2>Agendamentos</h2>
            <p>Seus agendamentos aparecerão aqui.</p>
        </div>
        <div id="sair" class="tab">
            <h2>Sair</h2>
            <p>Deseja realmente sair?</p>
        </div>
    </div>
</div>