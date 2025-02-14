<?php

class ClienteController extends Controller{
    private $clienteModel;
    private $dashboardModel;
    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->clienteModel = new Cliente();
        $this->dashboardModel = new Dashboard();
    }
    public function listar(){

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }
        $dados = array();
        $dados['conteudo'] = 'dash/cliente/listar';
        $dados['listarCliente']=$this->clienteModel->getlistarCliente();
        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard',$dados);
    }
}