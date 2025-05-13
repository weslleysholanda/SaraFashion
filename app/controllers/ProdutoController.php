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
        $dados['listarProduto'] = $this->produtoModel->getProduto();
        $this->CarregarViews('produto', $dados);
    }


    public function detalhe($link)
    {
        $dados = array();

        // Busca o produto pelo link
        $detalheProduto = $this->produtoModel->getProdutoLink($link);

        if ($detalheProduto) {
            $dados['titulo'] = $detalheProduto['nome_produto'];
            $dados['detalhe'] = $detalheProduto;

            // Agora buscamos todas as imagens corretamente pelo ID do produto
            $dados['produto'] = $this->produtoModel->getProdutoById($detalheProduto['id_produto']);

            // Lista produtos aleatórios para exibir sugestões na página
            $dados['listarProduto'] = $this->produtoModel->getProdutoAleatorio(3);

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
            // Filtrando e sanitizando os inputs
            $nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_produto = filter_input(INPUT_POST, 'descricao_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $informacao_produto = filter_input(INPUT_POST, 'informacao_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_produto = filter_input(INPUT_POST, 'preco_produto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantidade_estoque_produto = filter_input(INPUT_POST, 'quantidade_estoque_produto', FILTER_SANITIZE_NUMBER_INT);
            $status_produto = filter_input(INPUT_POST, 'status_produto', FILTER_SANITIZE_SPECIAL_CHARS);

            // Validando campos obrigatórios
            if (!empty($nome_produto) && !empty($descricao_produto) && $preco_produto !== false) {
                // Gerar o link do produto
                $link_produto = $this->gerarLinkProduto($nome_produto);

                // Criando array com os dados do produto
                $dadosProduto = [
                    'nome_produto' => $nome_produto,
                    'descricao_produto' => $descricao_produto,
                    'informacao_produto' => $informacao_produto,
                    'preco_produto' => $preco_produto,
                    'quantidade_estoque_produto' => $quantidade_estoque_produto,
                    'status_produto' => $status_produto,
                    'link_produto' => $link_produto
                ];

                // Inserindo o produto no banco e retornando o ID
                $id_produto = $this->produtoModel->addProduto($dadosProduto);

                if ($id_produto) {
                    if (isset($_FILES['foto_galeria'])) {
                        $fotos = $_FILES['foto_galeria'];
                        $contFoto = 1;

                        foreach (array_keys($fotos['name']) as $key) {
                            $arquivo = [
                                'name'     => $fotos['name'][$key],
                                'type'     => $fotos['type'][$key],
                                'tmp_name' => $fotos['tmp_name'][$key],
                                'error'    => $fotos['error'][$key],
                                'size'     => $fotos['size'][$key]
                            ];

                            // var_dump($fotos['name']);
                            if ($arquivo['error'] === 0) {
                                // Upload da foto com nome sequencial
                                $arquivoFoto = $this->uploadFoto($arquivo, $link_produto . ($contFoto == 1 ? "" : $contFoto));

                                if ($arquivoFoto) {
                                    // Inserindo a imagem na galeria do produto
                                    $this->produtoModel->addFotoGaleria($id_produto, $arquivoFoto, $nome_produto . $contFoto);
                                    $contFoto++;
                                } else {
                                    $_SESSION['mensagem'] = "Erro ao salvar uma das imagens.";
                                    $_SESSION['tipo-msg'] = "erro-foto";
                                }
                            }
                        }
                    }

                    // Mensagem de sucesso e redirecionamento
                    $_SESSION['mensagem'] = "Produto adicionado com sucesso!";
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sarafashion/public/produto/listar');
                    exit;
                } else {
                    // Erro ao inserir produto no banco
                    $_SESSION['mensagem'] = "Erro ao adicionar o produto";
                    $_SESSION['tipo-msg'] = "erro-produto";
                }
            } else {
                // Erro de validação dos campos obrigatórios
                $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios";
                $_SESSION['tipo-msg'] = "erro";
            }
        }



        // Métodos da classe DashboardController
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
        $dados['conteudo'] = 'dash/produto/editar';

        if ($id == null) {
            header('Location: http://localhost/sarafashion/public/produto/listar');
            exit;
        }

        $produto = $this->produtoModel->getProdutoById($id);
        $dados['produto'] = $produto;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Dados do produto
            $nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_produto = filter_input(INPUT_POST, 'descricao_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $informacao_produto = filter_input(INPUT_POST, 'informacao_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_produto = filter_input(INPUT_POST, 'preco_produto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $quantidade_estoque_produto = filter_input(INPUT_POST, 'quantidade_estoque_produto', FILTER_VALIDATE_INT);
            $status_produto = filter_input(INPUT_POST, 'status_produto', FILTER_SANITIZE_SPECIAL_CHARS);

            $link_produto = $this->gerarLinkProduto($nome_produto);

            // Processar as imagens enviadas
            $novosArquivos = [];
            $altsGaleria = [];

            if (!empty($_FILES['foto_galeria']['name'])) {
                foreach ($_FILES['foto_galeria']['name'] as $index => $fileName) {
                    if ($_FILES['foto_galeria']['error'][$index] === UPLOAD_ERR_OK) {
                        $file = [
                            'name' => $_FILES['foto_galeria']['name'][$index],
                            'tmp_name' => $_FILES['foto_galeria']['tmp_name'][$index]
                        ];

                        $uploadedFilePath = $this->uploadFoto($file, $link_produto . "_img" . ($index + 1));

                        if ($uploadedFilePath) {
                            $novosArquivos[] = $uploadedFilePath;
                            $altsGaleria[] = $nome_produto . " " . ($index + 1);
                        }
                    }
                }

                // Atualiza as imagens no banco
                if (!empty($novosArquivos)) {
                    $this->produtoModel->atualizarFotoGaleria($id, $novosArquivos, $altsGaleria);
                }
            }

            // Atualizar os dados do produto
            if ($nome_produto && $descricao_produto && $preco_produto !== false) {
                $dadosProduto = array(
                    'nome_produto' => $nome_produto,
                    'descricao_produto' => $descricao_produto,
                    'informacao_produto' => $informacao_produto,
                    'preco_produto' => $preco_produto,
                    'quantidade_estoque_produto' => $quantidade_estoque_produto,
                    'status_produto' => $status_produto,
                    'link_produto' => $link_produto
                );

                $resultado = $this->produtoModel->atualizarProduto($id, $dadosProduto);

                if ($resultado) {
                    $_SESSION['mensagem'] = "Produto atualizado com Sucesso!";
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sarafashion/public/produto/listar');
                    exit;
                } else {
                    $_SESSION['mensagem'] = "Erro ao atualizar o produto";
                    $_SESSION['tipo-msg'] = "erro";
                    header('Location: http://localhost/sarafashion/public/produto/adicionar');
                    exit;
                }
            }
        }

        // Métodos da classe DashboardController
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

        $resultado = $this->produtoModel->desativarProduto($id);
        header('Content-Type: Application/json');

        if ($resultado) {
            $_SESSION['mensagem'] = 'Produto desativado com sucesso!';
            $_SESSION['tipo-msg'] = 'sucesso';

            echo json_encode(['sucesso' => true]);
        } else {

            $_SESSION['mensagem'] = 'Falha ao desativar o produto';
            $_SESSION['tipo-msg'] = 'erro';

            echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao desativar o produto']);
        }
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


    private function uploadFoto($file, $link_produto)
    {
        $dir = '../public/uploads/';

        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nome_arquivo = $link_produto . '.' . $ext;
        $caminho_final = $dir . $nome_arquivo;

        if (move_uploaded_file($file['tmp_name'], $caminho_final)) {
            return 'produto/' . $nome_arquivo;
        }

        return false;
    }
}
