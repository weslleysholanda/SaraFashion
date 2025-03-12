<?php

class DashboardController extends Controller{
    private $dashboardModel;
    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->dashboardModel = new Dashboard();
    }
    public function index(){
        if (!isset($_SESSION['userId']) || !isset($_SESSION['userTipo'])) {
            header('Location:' . BASE_URL);
            exit();
        }

        
        $dados = array();
        $dados['titulo'] = 'Dashboard - Sara Fashion';
        $dados['nomeUser'] = $_SESSION['userNome'];
        $dados['idUser'] = $_SESSION['userId'];
        $dados['tipoUser'] = $_SESSION['userTipo'];

        //pegar dados do usuario Logado
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }
}