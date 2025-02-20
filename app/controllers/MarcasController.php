<?php

class MarcasController extends Controller{
    private $marcasModel;
    private $dashboardModel;
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $this->marcasModel = new Marcas();
        $this->dashboardModel = new Dashboard();

    }
    public function listar(){
        $dados = array();
        $dados['conteudo'] = 'dash/marcas/listar';
        $dados['listarMarcas'] = $this->marcasModel->getLogoNome();

        // Dashboard
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard',$dados);
    }

    public function adicionar(){
        $dados = array();
        $dados['conteudo'] = 'dash/marcas/adicionar';
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome_marca = filter_input(INPUT_POST, 'nome_marca', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $alt_marca  = $nome_marca; 
            $status_marcas  = filter_input(INPUT_POST, 'status_marcas', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    
            // Inicializa logo_marca como NULL inicialmente
            $logo_marca = null;
    
            if (isset($_FILES['logo_marca']) && $_FILES['logo_marca']['error'] == 0) {
                $logo_marca = $this->uploadFoto($_FILES['logo_marca'], $nome_marca);
            }
    
            if (!$logo_marca) {
                $_SESSION['mensagem'] = "A imagem da marca é obrigatória!";
                $_SESSION['tipo-msg'] = 'erro';
                header('Location: http://localhost/sarafashion/public/marcas/adicionar');
                exit;
            }
    
            $dadosMarca = [
                'nome_marca' => $nome_marca,
                'logo_marca' => $logo_marca,
                'alt_marca'  => $nome_marca,
                'status_marcas' => $status_marcas,
            ];
    
            $id_marca = $this->marcasModel->addMarca($dadosMarca);
    
            if ($id_marca) {
                $_SESSION['mensagem'] = "Marca adicionada com Sucesso!";
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: http://localhost/sarafashion/public/marcas/listar');
                exit;
            } else {
                $_SESSION['mensagem'] = "Erro ao adicionar a marca";
                $_SESSION['tipo-msg'] = 'erro';
                header('Location: http://localhost/sarafashion/public/marcas/adicionar');
                exit;
            }
        }
    
        // Dashboard
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }
    
    
    private function uploadFoto($file, $nome_marca) {
        $dir = '../public/uploads/';
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nome_arquivo = 'marca/' . strtolower(str_replace(' ', '_', $nome_marca)) . '.' . $ext;
    
        if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
            return $nome_arquivo;
        }   
    
        return false;
    }
}