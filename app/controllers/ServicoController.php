<?php

class ServicoController extends Controller
{

    private $servicoModel;
    private $dashboardModel;
    private $especialidadeModel;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->servicoModel = new Servico();
        $this->dashboardModel = new Dashboard();
        $this->especialidadeModel = new Especialidade();
    }
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Serviços - Sara Fashion';


        // obter 3 serviços aleatorios
        $dados['servicos'] = $this->servicoModel->getServicoAleatorio(3);

        // $nomeServico = $servicoModel->getNomeServicoAleatorio(4);



        // $dados['nomeServico'] = $nomeServico;

        $this->carregarViews('servico', $dados);
    }

    // BACK - END - DASHBOARD

    public function listar()
    {

        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarServico'] = $this->servicoModel->getServicoAll();
        // var_dump('listarServico');
        $dados['conteudo'] = 'dash/servico/listar';

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
        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome_servico = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_servico = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_base_servico = filter_input(INPUT_POST, 'preco_base_servico', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $tempo_estimado_servico = filter_input(INPUT_POST, 'tempo_estimado_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_foto_servico = $nome_servico;
            $id_especialidade = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
            $status_servico = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $nova_especialidade = filter_input(INPUT_POST, 'nova_especialidade', FILTER_SANITIZE_SPECIAL_CHARS);

            // Verifica se a especialidade precisa ser criada
            if (empty($id_especialidade) && !empty($nova_especialidade)) {
                $id_especialidade = $this->servicoModel->obterOuCriarEspecialidade($nova_especialidade);
            }

            // Valida se a especialidade foi definida
            if (empty($id_especialidade)) {
                $_SESSION['mensagem'] = "É necessário escolher ou criar uma especialidade!";
                $_SESSION['tipo-msg'] = "erro";
                header('Location: http://localhost/sarafashion/public/servico/adicionar');
                exit;
            }

            // Verifica se a foto foi enviada
            $foto_servico = null;
            if (isset($_FILES['foto_servico']) && $_FILES['foto_servico']['error'] == 0) {
                $foto_servico = $this->uploadFoto($_FILES['foto_servico'], $nome_servico);
            }

            // Se a foto for obrigatória e não existir, retorna erro
            if (!$foto_servico) {
                $_SESSION['mensagem'] = "A foto do serviço é obrigatória!";
                $_SESSION['tipo-msg'] = 'erro';
                header('Location: http://localhost/sarafashion/public/servico/adicionar');
                exit;
            }

            // Prepara os dados para inserção no banco
            $dadosServico = [
                'nome_servico' => $nome_servico,
                'descricao_servico' => $descricao_servico,
                'preco_base_servico' => $preco_base_servico,
                'tempo_estimado_servico' => $tempo_estimado_servico,
                'foto_servico' => $foto_servico,
                'alt_foto_servico' => $nome_servico,
                'id_especialidade' => $id_especialidade,
                'status_servico' => $status_servico,
            ];

            // Insere no banco
            $id_servico = $this->servicoModel->addServico($dadosServico);

            if ($id_servico) {
                $_SESSION['mensagem'] = "Serviço adicionado com Sucesso!";
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: http://localhost/sarafashion/public/servico/listar');
                exit;
            } else {
                $_SESSION['mensagem'] = "Erro ao adicionar o serviço";
                $_SESSION['tipo-msg'] = "erro";
                header('Location: http://localhost/sarafashion/public/servico/adicionar');
                exit;
            }
        }

        $dados['conteudo'] = 'dash/servico/adicionar';
        $dados['listarEspecialidade'] = $this->especialidadeModel->getListarEspecialidade();

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard', $dados);
    }

    public function editar($id = null)
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }
        $dados = array();
        $dados['conteudo'] = 'dash/servico/editar';

        if ($id == null) {
            header('Location: http://localhost/sarafashion/public/servico/listar');
            exit;
        }
        $servico = $this->servicoModel->getServicoById($id);
        $dados['servico'] = $servico;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtrando os dados do formulário
            $nome_servico = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_servico = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_base_servico = filter_input(INPUT_POST, 'preco_base_servico', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $tempo_estimado_servico = filter_input(INPUT_POST, 'tempo_estimado_servico');
            $alt_foto_servico = $nome_servico;
            $id_especialidade = filter_input(INPUT_POST, 'id_especialidade', FILTER_SANITIZE_NUMBER_INT);
            $status_servico = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $nova_especialidade = filter_input(INPUT_POST, 'nova_especialidade', FILTER_SANITIZE_SPECIAL_CHARS);
        
            // Manter a foto existente caso não seja alterada
            $foto_servico = $servico['foto_servico'];  
        
            // Verifica se foi enviada uma nova foto
            if (isset($_FILES['foto_servico']) && $_FILES['foto_servico']['error'] == 0) {
                // Faz o upload da nova foto e retorna o caminho
                $foto_servico = $this->uploadFoto($_FILES['foto_servico'], $nome_servico);
            }
        
            // Verifica se houve erro no upload
            if (!$foto_servico) {
                $_SESSION['mensagem'] = "Erro ao atualizar a foto do serviço";
                $_SESSION['tipo-msg'] = 'erro';
                header('Location: http://localhost/sarafashion/public/servico/editar/' . $id);
                exit;
            }
        
            // Se não houver especialidade, cria uma nova
            if (empty($id_especialidade) && !empty($nova_especialidade)) {
                $id_especialidade = $this->servicoModel->obterOuCriarEspecialidade($nova_especialidade);
            }
        
            if (empty($id_especialidade)) {
                $_SESSION['mensagem'] = "É necessário escolher ou criar uma especialidade!";
                $_SESSION['tipo-msg'] = "erro";
                header('Location: http://localhost/sarafashion/public/servico/editar/' . $id);
                exit;
            }
        
            // Dados para atualização do serviço
            $dadosServico = [
                'nome_servico'        => $nome_servico,
                'descricao_servico'   => $descricao_servico,
                'preco_base_servico'  => $preco_base_servico,
                'tempo_estimado_servico' => $tempo_estimado_servico,
                'foto_servico'        => $foto_servico,
                'alt_foto_servico'    => $alt_foto_servico,
                'id_especialidade'    => $id_especialidade,
                'status_servico'      => $status_servico
            ];
        
            // Atualiza o serviço no banco de dados
            $atualizado = $this->servicoModel->atualizarServico($id, $dadosServico);
        
            if ($atualizado) {
                $_SESSION['mensagem'] = "Serviço atualizado com sucesso!";
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: http://localhost/sarafashion/public/servico/listar');
                exit;
            } else {
                $_SESSION['mensagem'] = "Erro ao atualizar o serviço";
                $_SESSION['tipo-msg'] = "erro";
                header('Location: http://localhost/sarafashion/public/servico/editar/' . $id);
                exit;
            }
        }
        


        $dados['listarEspecialidade'] = $this->especialidadeModel->getListarEspecialidade();

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

        $resultado = $this->servicoModel->desativarServico($id);
        header('Content-Type: Application/json');

        if ($resultado) {
            $_SESSION['mensagem'] = 'Serviço desativado com sucesso!';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {

            $_SESSION['mensagem'] = 'Falha ao desativar';
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao desativar o serviço']);
        }
    }

    private function uploadFoto($file, $nome_servico)
    {
        $dir = '../public/uploads/';  // Diretório onde as fotos serão salvas
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);  // Cria o diretório caso não exista
        }

        // Obtém a extensão do arquivo de foto
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Cria um nome único para o arquivo, utilizando o nome do serviço
        $nome_arquivo = 'servico/' . strtolower(str_replace(' ', '_', $nome_servico)) . '.' . $ext;

        // Move o arquivo enviado para o diretório de uploads
        if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
            return $nome_arquivo;  // Retorna o nome do arquivo após o upload
        }

        return false;  // Retorna false em caso de erro no upload
    }
}
