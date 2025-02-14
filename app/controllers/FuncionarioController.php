<?php

class FuncionarioController extends Controller
{
    private $dashboardModel;
    private $funcionarioModel;
    private $especialidadedModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->funcionarioModel = new Funcionario();
        $this->dashboardModel = new Dashboard();
        $this->especialidadedModel = new Especialidade();
    }
    public function listar()
    {
        $dados = array();
        $dados['conteudo'] = 'dash/funcionario/listar';
        $dados['listarFuncionario'] = $this->funcionarioModel->getListarFuncionario();

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }

    public function adicionar()
    {
        $dados = array();
        $dados['conteudo'] = 'dash/funcionario/adicionar';
        $dados['listarEspecialidade'] = $this->especialidadedModel->getListarEspecialidade();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome_funcionario = filter_input(INPUT_POST, 'nome_funcionario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $tipo_funcionario = filter_input(INPUT_POST, 'tipo_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cnpj_funcionario = filter_input(INPUT_POST, 'cpf_cnpj_funcionario', FILTER_SANITIZE_NUMBER_FLOAT);
            $data_adm_funcionario = filter_input(INPUT_POST, 'data_adm_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_funcionario = filter_input(INPUT_POST, 'email_funcionario', FILTER_SANITIZE_EMAIL);
            $senha_funcionario = filter_input(INPUT_POST, 'senha_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_funcionario = filter_input(INPUT_POST, 'telefone_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_funcionario = filter_input(INPUT_POST, 'endereco_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_funcionario = filter_input(INPUT_POST, 'bairro_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_funcionario = filter_input(INPUT_POST, 'cidade_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $cargo_funcionario = filter_input(INPUT_POST, 'cargo_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_especialidade = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
            $salario_funcionario = filter_input(INPUT_POST, 'salario_funcionario', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $status_funcionario = filter_input(INPUT_POST, 'status_funcionario', FILTER_SANITIZE_SPECIAL_CHARS);

            // Formata a data para o formato correto (YYYY-MM-DD)
            if (!empty($data_adm_funcionario) && $data_adm_funcionario !== false) {
                $dataObj = DateTime::createFromFormat('d/m/Y', $data_adm_funcionario);
                if ($dataObj) {
                    $data_adm_funcionario = $dataObj->format('Y-m-d');
                }
            }


            // Upload da foto do funcionário
            $foto_funcionario = null;

            if (isset($_FILES['foto_funcionario']) && $_FILES['foto_funcionario']['error'] == 0) {
                $foto_funcionario = $this->uploadFoto($_FILES['foto_funcionario'], $nome_funcionario);
            }

            if (!$foto_funcionario) {
                $_SESSION['mensagem'] = "A foto do funcionário é obrigatória!";
                $_SESSION['tipo-msg'] = 'erro';
                header('Location: http://localhost/sarafashion/public/funcionario/adicionar');
                exit;
            }

            $dadosFuncionario = [
                'nome_funcionario' => $nome_funcionario,
                'tipo_funcionario' => $tipo_funcionario,
                'cpf_cnpj_funcionario' => $cpf_cnpj_funcionario,
                'data_adm_funcionario' => $data_adm_funcionario,
                'email_funcionario' => $email_funcionario,
                'senha_funcionario' => $senha_funcionario,
                'foto_funcionario' => $foto_funcionario,
                'alt_foto_funcionario' => $nome_funcionario,
                'telefone_funcionario' => $telefone_funcionario,
                'endereco_funcionario' => $endereco_funcionario,
                'bairro_funcionario' => $bairro_funcionario,
                'cidade_funcionario' => $cidade_funcionario,
                'cargo_funcionario' => $cargo_funcionario,
                'id_especialidade' => $id_especialidade,
                'salario_funcionario' => $salario_funcionario,
                'status_funcionario' => $status_funcionario,
            ];

            try {
                $id_funcionario = $this->funcionarioModel->addFuncionario($dadosFuncionario);

                if ($id_funcionario) {
                    $_SESSION['mensagem'] = "Funcionário adicionado com sucesso!";
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sarafashion/public/funcionario/listar');
                    exit;
                } else {
                    $_SESSION['mensagem'] = "Erro ao adicionar o funcionário.";
                    $_SESSION['tipo-msg'] = 'erro';
                }
            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    $erroMsg = "Erro! CPF/CNPJ ou Email já está cadastrado.";
                    $_SESSION['tipo-msg'] = 'erro';
                    header('Location: http://localhost/sarafashion/public/funcionario/adicionar');
                    exit;

                    // Verifica qual campo específico causou o erro
                    if (strpos($e->getMessage(), 'cpf_cnpj_funcionario') !== false) {
                        $erroMsg = "Erro! O CPF/CNPJ já está cadastrado.";
                    } elseif (strpos($e->getMessage(), 'email_funcionario') !== false) {
                        $erroMsg = "Erro! O Email já está cadastrado.";
                    }

                    $_SESSION['mensagem'] = $erroMsg;
                    $_SESSION['tipo-msg'] = 'erro';
                } else {
                    $_SESSION['mensagem'] = "Erro ao adicionar o funcionário.";
                    $_SESSION['tipo-msg'] = 'erro';
                }
            }

            header('Location: http://localhost/sarafashion/public/funcionario/adicionar');
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
        $dados = array();
        $dados['conteudo'] = 'dash/funcionario/editar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }

    public function desativar()
    {
        $dados = array();
        $dados['conteudo'] = 'dash/funcionario/desativar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }

    private function uploadFoto($file, $nome_funcionario)
    {
        $dir = '../public/uploads/';
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nome_arquivo = 'funcionario/' . strtolower(str_replace(' ', '_', $nome_funcionario)) . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
            return $nome_arquivo;
        }

        return false;
    }
}
