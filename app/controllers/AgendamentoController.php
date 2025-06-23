<?php

class AgendamentoController extends Controller
{

    private $agendamentoModel;
    private $dashboardModel;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->agendamentoModel = new Agendamento();
        $this->dashboardModel = new Dashboard();
    }

    // public function filtrarAgendamento(){

    //     $status = isset($_POST['status']) ? $_POST['status'] : 'Agendado';
    //     $listarAgendamentos = $this->agendamentoModel->getAgendamentoByStatus($status);
    //     echo json_encode($listarAgendamentos);
    // }

    // public function listar()
    // {
    //     if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

    //         header('Location:' . BASE_URL);
    //         exit;
    //     }

    //     $dados = array();
    //     $dados['conteudo'] = 'dash/agendamento/listar';
    //     $dados['listarAgendamento'] = $this->agendamentoModel->ListarAgendamento();
            


    //     //metodos da classe DashboardController
    //     $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
    //     $dados['depoimento'] = $this->dashboardModel->getDepoimento();
    //     $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
    //     $dados['venda'] = $this->dashboardModel->getVendas();

    //     $this->carregarViews('dash/dashboard', $dados);
    // }

    public function editar()
    {
        $dados = array();
        $dados['conteudo'] = 'dash/agendamento/editar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }

    public function desativar($id = null)
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        if ($id === null) {
            http_response_code(400);
            echo json_encode(["sucesso" => false, "mensagem" => "ID inválido"]);
            exit;
        }

        $resultado = $this->agendamentoModel->cancelarAgendamento($id);
        header('Content-Type: Application/json');

        if ($resultado) {
            $_SESSION['mensagem'] = 'Agendamento cancelado com sucesso!';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {

            $_SESSION['mensagem'] = 'Falha ao cancelar';
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao cancelar o Agendamento']);
        }
    }
}
