<?php

class EspecialidadeController extends Controller{
    private $especialidadeModel;
    private $dashboardModel;
    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->especialidadeModel=new Especialidade();
        $this->dashboardModel =new Dashboard();
    }
    public function listar(){
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo']='dash/especialidade/listar';
        $dados['listarEspecialidade']=$this->especialidadeModel->getListarEspecialidade();

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();

        $this->carregarViews('dash/dashboard',$dados);
    }

    public function adicionar(){
        $dados = array();
        $dados['conteudo'] = 'dash/especialidade/adicionar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard',$dados);
    }

    public function editar($id = null){
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }
        $dados = array();
        $dados['conteudo'] = 'dash/especialidade/editar';

        if ($id == null) {
            header('Location: http://localhost/sarafashion/public/marcas/listar');
            exit;
        }

        $especialidade = $this->especialidadeModel->getEspecialidadeById($id);
        $dados['especialidade'] = $especialidade;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_especialidade   = filter_input(INPUT_POST, 'nome_especialidade', FILTER_SANITIZE_SPECIAL_CHARS);


            $dadosEspecialidade = [
                'nome_especialidade' => $nome_especialidade
            ];


            $atualizado = $this->especialidadeModel->atualizarEspecialidade($id, $dadosEspecialidade);

            if ($atualizado) {
                $_SESSION['mensagem'] = "Especialidade atualizado com sucesso!";
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: http://localhost/sarafashion/public/especialidade/listar');
                exit;
            } else {
                $_SESSION['mensagem'] = "Erro ao atualizar a logo da marca";
                $_SESSION['tipo-msg'] = "erro";
                header('Location: http://localhost/sarafashion/public/especialidade/editar/' . $id);
                exit;
            }
        }

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
 
        $this->carregarViews('dash/dashboard', $dados);
    }

    public function filtrarEspecialidade(){

        $status = isset($_POST['status']) ? $_POST['status'] : 'Ativo';
        $listarEspecialidade = $this->especialidadeModel->getEspecialidadeByStatus($status);
        echo json_encode($listarEspecialidade);
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

        $resultado = $this->especialidadeModel->desativarEspecialidade($id);
        header('Content-Type: Application/json');

        if ($resultado) {
            $_SESSION['mensagem'] = 'Especialidade desativada com sucesso!';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {

            $_SESSION['mensagem'] = 'Falha ao desativar';
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao desativar a especialidade']);
        }
    }

    public function ativar($id = null)
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

        $resultado = $this->especialidadeModel->ativarEspecialidade($id);
        header('Content-Type: Application/json');

        if ($resultado) {
            $_SESSION['mensagem'] = 'Especialidade ativada com sucesso!';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {

            $_SESSION['mensagem'] = 'Falha ao ativar';
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao ativar a especialidade']);
        }
    }

}