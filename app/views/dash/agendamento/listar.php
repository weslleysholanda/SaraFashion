<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem']) && isset($_SESSION['tipo-msg'])) {

    $mensagem = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipo-msg'];

    /**Exibir a mensagem */
    if ($tipo == 'sucesso') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong> ' . $mensagem . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } elseif ($tipo == 'erro') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> ' . $mensagem . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    /** Limpe as variáveis de sessão */
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo-msg']);
}


?>
<h1>Agendamento</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Funcionário</th>
            <th scope="col">Serviço</th>
            <th scope="col">Agendamento</th>
            <th scope="col">Status</th>
            <th scope="col">Detalhes</th>
            <th scope="col">Cancelar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarAgendamento as $linha): ?>
            <tr>
                <td class="imgBanco"><img src="<?php
                            $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/sarafashion/public/uploads/" . $linha['foto_cliente'];
                                        if ($linha['foto_cliente'] != "") {
                                            if (file_exists($caminhoArquivo)){
                                                echo ("http://localhost/sarafashion/public/uploads/" .htmlspecialchars($linha['foto_cliente'], ENT_QUOTES, 'UTF-8'));
                                            } else {
                                                echo ("http://localhost/sarafashion/public/uploads/cliente/sem-foto-cliente.png");
                                            }
                                        } else {
                                            echo ("http://localhost/sarafashion/public/uploads/cliente/sem-foto-cliente.png");
                                        }
                                        ?>" alt="<?php echo htmlspecialchars($linha['alt_foto_cliente'],ENT_QUOTES,'UTF-8') ?>"></td>
                <td><?php echo $linha['nome_cliente'] ?></td>
                <td><?php echo $linha['nome_funcionario'] ?></td>
                <td><?php echo $linha['nome_servico'] ?></td>
                <td><?php echo date_format(date_create($linha['data_agendamento']), 'd/m/Y H:i'); ?></td>
                <td><?php echo $linha['status_agendamento'] ?></td>
                <td><i id="btn-primary" class="bi bi-file-text"></i></td>
                <td><i id="btn-secundary" onclick="abrirModalCancelar(<?php echo $linha['id_agendamento'];?>)" class="bi bi-ban"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- Modal cancelar agendamento -->
<div class="modal faded" tabindex="-1" id="modalCancelar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancelar Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja cancelar esse agendamento?</p>
                <input type="hidden" id="idAgendamentoCancelar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmar">Cancelar Agendamento</button>
            </div>
        </div>
    </div>
</div>