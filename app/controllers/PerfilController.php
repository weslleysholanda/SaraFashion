<?php

// PerfilController.php
class PerfilController extends Controller
{
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Perfil - Cliente';

        if (!isset($_SESSION['userId']) || $_SESSION['userTipo'] !== 'Cliente') {
            $_SESSION['perfil-erro'] = 'Você precisa estar logado como cliente para acessar o perfil.';
            header('Location: ' . BASE_URL);
            exit;
        }

        $clienteModel = new Cliente();
        $dados['cliente'] = $clienteModel->buscarClientePorId($_SESSION['userId']);

        if (!$dados['cliente']) {
            $_SESSION['perfil-erro'] = 'Erro ao carregar dados do perfil. Tente novamente.';
            header('Location: ' . BASE_URL);
            exit;
        }

        // Verifica se todos os dados do cliente estão preenchidos
        if (empty($dados['cliente']['telefone_cliente']) || empty($dados['cliente']['endereco_cliente']) || empty($dados['cliente']['bairro_cliente'])) {
            $dados['aviso'] = 'Por favor, complete seu perfil com os dados obrigatórios.';
        }

        $this->carregarViews('perfil', $dados);
    }

    public function editar()
    {
        if (!isset($_SESSION['userId']) || $_SESSION['userTipo'] !== 'Cliente') {
            echo json_encode([
                'sucesso' => false,
                'mensagem' => 'Você precisa estar logado como cliente para acessar o perfil.'
            ]);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteModel = new Cliente();

            // Filtra os dados do formulário
            $nome_cliente = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $senha_cliente = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo_cliente = filter_input(INPUT_POST, 'tipo_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cnpj_cliente = filter_input(INPUT_POST, 'cpf_cnpj_cliente', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_cliente = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_cliente = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nasc_cliente = filter_input(INPUT_POST, 'data_nasc_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

            $foto_cliente = '';

            // Se houver nova foto
            if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] === 0) {
                $foto_cliente = $this->uploadFoto($_FILES['foto_cliente'], $nome_cliente);

                if (!$foto_cliente) {
                    echo json_encode([
                        'sucesso' => false,
                        'mensagem' => 'Erro ao fazer upload da foto.'
                    ]);
                    exit;
                }
            } else {
                $foto_cliente = $clienteModel->buscarClientePorId($_SESSION['userId'])['foto_cliente'];
            }

            $dadosCliente = [
                'nome_cliente' => $nome_cliente,
                'telefone_cliente' => $telefone_cliente,
                'email_cliente' => $email_cliente,
                'senha_cliente' => $senha_cliente,
                'tipo_cliente' => $tipo_cliente,
                'cpf_cnpj_cliente' => $cpf_cnpj_cliente,
                'endereco_cliente' => $endereco_cliente,
                'bairro_cliente' => $bairro_cliente,
                'cidade_cliente' => $cidade_cliente,
                'data_nasc_cliente' => $data_nasc_cliente,
                'foto_cliente' => $foto_cliente,
            ];

            if ($clienteModel->atualizarCliente($_SESSION['userId'], $dadosCliente)) {
                header('Content-Type: application/json');
                echo json_encode([
                    'sucesso' => true,
                    'mensagem' => 'Perfil atualizado com sucesso!',
                    'novaFoto' => $foto_cliente
                ]);
            } else {
                echo json_encode([
                    'sucesso' => false,
                    'mensagem' => 'Erro ao atualizar o perfil.'
                ]);
            }
            exit;
        }

        // GET: carrega view normalmente
        $dados['titulo'] = 'Editar Perfil - Cliente';
        $clienteModel = new Cliente();
        $dados['cliente'] = $clienteModel->buscarClientePorId($_SESSION['userId']);
        $this->carregarViews('perfil', $dados);
    }






    public function logout()
    {
        // Inicia a sessão
        session_start();

        // Remove todas as variáveis de sessão
        session_unset();

        // Destroi a sessão
        session_destroy();

        // Redireciona para a página inicial
        header("Location: " . BASE_URL);
        exit();
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
