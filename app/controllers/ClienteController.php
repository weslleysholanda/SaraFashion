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

    public function adicionar(){
        $dados = array();
        $dados['conteudo'] = 'dash/cliente/adicionar';


        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }

    public function filtrarCliente(){

        $status = isset($_POST['status']) ? $_POST['status'] : 'Ativo';
        $listarCliente = $this->clienteModel->getClientesByStatus($status);
        echo json_encode($listarCliente);
    }

    public function desativar($id = null){
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        if($id === null){
            http_response_code(400);
            echo json_encode(["sucesso" => false, "mensagem" => "ID inválido"]);
            exit;
        }

        $resultado = $this->clienteModel->desativarCliente($id);
        header('Content-Type: Application/json');

        if($resultado){
            $_SESSION['mensagem'] = 'Cliente desativado com sucesso!';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        }else{

            $_SESSION['mensagem'] = 'Falha ao desativar';
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao desativar o cliente']);
        }
    }

    public function ativar($id = null){
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        if($id === null){
            http_response_code(400);
            echo json_encode(["sucesso" => false, "mensagem" => "ID inválido"]);
            exit;
        }

        $resultado = $this->clienteModel->ativarCliente($id);
        header('Content-Type: Application/json');

        if($resultado){
            $_SESSION['mensagem'] = 'Cliente ativado com sucesso!';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        }else{

            $_SESSION['mensagem'] = 'Falha ao ativar';
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao ativar o cliente']);
        }
    }


    private function uploadFoto($file, $nome_cliente)
    {   
        $dir = '../public/uploads/';
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nome_arquivo = 'cliente/' . strtolower(str_replace(' ', '_', $nome_cliente)) . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
            return $nome_arquivo;
        }

        return false;
    }
}