<?php

class DashboardController extends Controller{
    // private $dashboardModel;
    // public function __construct(){

    //     $this->dashboardModel = new Dashboard();
    // }
    public function index(){
        if (!isset($_SESSION['userId']) || !isset($_SESSION['userTipo'])) {
            header('Location:' . BASE_URL);
            exit();
        }

        $dashboardModel = new Dashboard();
        
        $dados = array();
        $dados['titulo'] = 'Dashboard - Sara Fashion';
        $dados['nomeUser'] = $_SESSION['userNome'];
        $dados['idUser'] = $_SESSION['userId'];
        $dados['tipoUser'] = $_SESSION['userTipo'];

        //pegar dados do usuario Logado
        $dados['usuario'] = $dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $dashboardModel->getDepoimento();
        $dados['cadastro'] = $dashboardModel->getTotalRegistros();
        $dados['venda'] = $dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }
}