<?php 

class DepoimentoController extends Controller{
    private $dashboardModel;
    private $depoimentoModel;
    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->dashboardModel = new Dashboard();
        $this->depoimentoModel = new Depoimento();
    }

    public function listar(){

        $dados = array();
        $dados['conteudo'] = 'dash/depoimento/listar';
        $dados['listarDepoimento'] = $this->depoimentoModel->getListarDepoimento();

        // Dashboard Controller
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard',$dados);
    }
}