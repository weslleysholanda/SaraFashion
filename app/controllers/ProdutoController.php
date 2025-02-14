<?php

class ProdutoController extends Controller
{
    private $produtoModel;
    private $dashboardModel;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->produtoModel = new Produto();
        $this->dashboardModel = new Dashboard();
    }
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Produto - Sara Fashion';
        $dados['produto'] = $this->produtoModel->getProduto();
        $this->CarregarViews('produto', $dados);
    }

    public function detalhe($link)
    {
        // var_dump($link);

        $dados = array();

        $detalheProduto = $this->produtoModel->getProdutoLink($link);
        $dados['listarProduto'] = $this->produtoModel->getProdutoAleatorio(3);


        if ($detalheProduto  != "") {
            $dados['titulo'] = $detalheProduto['nome_produto'];
            $dados['detalhe'] = $detalheProduto;

            $this->carregarViews('produto', $dados);
        } else {
            $this->carregarViews('error404', $dados);
        }
    }

    public function listar()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo'] = 'dash/produto/listar';
        $dados['listarProduto'] = $this->produtoModel->getProduto();

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }

    public function adicionar()
    {
        // Verificação de permissão do usuário
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['conteudo'] = 'dash/produto/adicionar';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_produto = filter_input(INPUT_POST, 'descricao_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $informacao_produto = filter_input(INPUT_POST, 'informacao_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_produto = filter_input(INPUT_POST, 'preco_produto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantidade_estoque_produto = filter_input(INPUT_POST, 'quantidade_estoque_produto', FILTER_SANITIZE_NUMBER_INT);
            $status_produto = filter_input(INPUT_POST, 'status_produto', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($nome_produto && $descricao_produto && $preco_produto !== false) {

                /** 1- Gerar link do produto */
                $link_produto = $this->gerarLinkProduto($nome_produto);

                /** 2- Preparar dados */
                $dadosProduto = array(
                    'nome_produto'              => $nome_produto,
                    'descricao_produto'         => $descricao_produto,
                    'informacao_produto'        => $informacao_produto,
                    'preco_produto'             => $preco_produto,
                    'quantidade_estoque_produto' => $quantidade_estoque_produto,
                    'status_produto'            => $status_produto,
                    'link_produto'              => $link_produto,
                );

                /** 3- Inserir o produto e obter o ID */
                $id_produto = $this->produtoModel->addProduto($dadosProduto);

                if ($id_produto) {
                    // Verifica se há arquivos enviados
                    if (isset($_FILES['foto_galeria']) && count($_FILES['foto_galeria']['name']) > 0) {
                        for ($i = 0; $i < count($_FILES['foto_galeria']['name']); $i++) {
                            if ($_FILES['foto_galeria']['error'][$i] == 0) {
                                // Cria um nome único para cada arquivo
                                $arquivo = $this->uploadFoto($_FILES['foto_galeria']['name'][$i], $_FILES['foto_galeria']['tmp_name'][$i], $link_produto, $i + 1);

                                if ($arquivo) {
                                    // Salva na tabela galeria
                                    $this->produtoModel->addFotoGaleria($id_produto, $arquivo, $nome_produto);
                                }
                            }
                        }
                    }

                    /** Mensagem de Sucesso */
                    $_SESSION['mensagem'] = "Produto adicionado com Sucesso!";
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sarafashion/public/produto/listar');
                    exit;
                } else {
                    $dados['mensagem'] = "Erro ao adicionar o produto";
                    $dados['tipo-msg'] = "erro-produto";
                }
            } else {
                $dados['mensagem'] = "Preencha todos os campos obrigatórios";
                $dados['tipo-msg'] = "erro";
            }
        }

        // Métodos da classe DashboardController
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
        $dados['conteudo'] = 'dash/produto/editar';


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
        $dados['conteudo'] = 'dash/produto/desativar';

        //metodos da classe DashboardController
        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }


    public function gerarLinkProduto($nome_produto)
    {
        // Remover acentos
        $semAcento = iconv('UTF-8', 'ASCII//TRANSLIT', $nome_produto);

        // Substituir espaços e caracteres inválidos por hífen
        $link = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $semAcento)));

        // Evita hífen no final ou início
        $link = trim($link, '-');

        // Verifica se o link já existe
        $contador = 1;
        $link_original = $link;
        while ($this->produtoModel->existeEsseProduto($link)) {
            $link = $link_original . '-' . $contador;
            $contador++;
        }

        return $link;
    }


    private function uploadFoto($file_name, $file_tmp, $link_produto, $index)
    {
        $dir = __DIR__ . '../public/uploads/produto/';

        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $nome_arquivo = $link_produto . '_' . $index . '.' . $ext;

        if (move_uploaded_file($file_tmp, $dir . $nome_arquivo)) {
            return 'produto/' . $nome_arquivo;
        }
        return false;
    }
}
