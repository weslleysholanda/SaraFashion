<?php

class AgendamentoController extends Controller{

    private $agendamentoModel;
    private $dashboardModel;
    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->agendamentoModel = new Agendamento();
        $this->dashboardModel = new Dashboard();
    }
    public function listar(){
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo']='dash/agendamento/listar';
        $dados['listarAgendamento']=$this->agendamentoModel->ListarAgendamento();

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard',$dados);
    }

    public function editar(){
        $dados = array();
        $dados['conteudo']='dash/agendamento/editar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard',$dados);
    }

    public function desativar(){
        $dados = array();
        $dados['conteudo'] = 'dash/agendamento/desativar';
        
        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard',$dados);
    }
}