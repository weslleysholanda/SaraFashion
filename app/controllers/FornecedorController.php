<?php

class FornecedorController extends Controller
{
    private $fornecedorModel;
    private $dashboardModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->fornecedorModel = new Fornecedor();
        $this->dashboardModel = new Dashboard();
        
    }
    public function listar()
    {

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo'] = 'dash/fornecedor/listar';
        $dados['listarFornecedor'] = $this->fornecedorModel->getListarFornecedor();

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }

    public function adicionar()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados['tipoFornecedor'] = $this->fornecedorModel->getListarFornecedor();

        $dados = array();
        $dados['conteudo'] = 'dash/fornecedor/adicionar';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome_fornecedor = filter_input(INPUT_POST, 'nome_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $tipo_fornecedor = filter_input(INPUT_POST, 'tipo_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cpf_cnpj_fornecedor = filter_input(INPUT_POST, 'cpf_cnpj_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data_cad_fornecedor = filter_input(INPUT_POST, 'data_cad_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $telefone_fornecedor = filter_input(INPUT_POST, 'telefone_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email_fornecedor = filter_input(INPUT_POST, 'email_fornecedor', FILTER_SANITIZE_EMAIL);
            $endereco_fornecedor = filter_input(INPUT_POST, 'endereco_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cidade_fornecedor = filter_input(INPUT_POST, 'cidade_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $produto_fornecido = filter_input(INPUT_POST, 'produto_fornecido', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $status_fornecedor = filter_input(INPUT_POST, 'status_fornecedor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            if (!empty($data_cad_fornecedor)) {
                $dataObj = DateTime::createFromFormat('d/m/Y', $data_cad_fornecedor);
                if ($dataObj) {
                    $data_cad_fornecedor = $dataObj->format('Y-m-d'); // Converte para YYYY-MM-DD
                }
            }
        
            $dadosFornecedor = [
                'nome_fornecedor' => $nome_fornecedor,
                'tipo_fornecedor' => $tipo_fornecedor,
                'cpf_cnpj_fornecedor' => $cpf_cnpj_fornecedor,
                'data_cad_fornecedor' => $data_cad_fornecedor,
                'telefone_fornecedor' => $telefone_fornecedor,
                'email_fornecedor' => $email_fornecedor,
                'endereco_fornecedor' => $endereco_fornecedor,
                'cidade_fornecedor' => $cidade_fornecedor,
                'produto_fornecido' => $produto_fornecido,
                'status_fornecedor' => $status_fornecedor,
            ];
        
            try {
                $id_fornecedor = $this->fornecedorModel->addFornecedor($dadosFornecedor);
            
                if ($id_fornecedor) {
                    $_SESSION['mensagem'] = "Fornecedor adicionado com sucesso!";
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sarafashion/public/fornecedor/listar');
                    exit;
                } else {
                    $_SESSION['mensagem'] = "Erro ao adicionar o fornecedor.";
                    $_SESSION['tipo-msg'] = 'erro';
                }
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) { // Código de erro para entrada duplicada no MySQL
                    $erroMsg = "Erro! CPF/CNPJ ou Email já está cadastrado.";
            
                    // Verifica qual campo específico causou o erro
                    if (strpos($e->getMessage(), 'cpf_cnpj_fornecedor') !== false) {
                        $erroMsg = "Erro! O CPF/CNPJ já está cadastrado.";
                    } elseif (strpos($e->getMessage(), 'email_fornecedor') !== false) {
                        $erroMsg = "Erro! O Email já está cadastrado.";
                    }
            
                    $_SESSION['mensagem'] = $erroMsg;
                    $_SESSION['tipo-msg'] = 'erro';
                } else {
                    $_SESSION['mensagem'] = "Erro ao adicionar o fornecedor.";
                    $_SESSION['tipo-msg'] = 'erro';
                }
            }
            
            header('Location: http://localhost/sarafashion/public/fornecedor/adicionar');
            exit;
            
        }
        


        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }

    public function editar()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo'] = 'dash/fornecedor/editar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }

    public function desativar()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo'] = 'dash/fornecedor/desativar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }
}
