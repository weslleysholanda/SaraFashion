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
        // Inicializa a variável de dados
        $dados = array();
        $dados['titulo'] = 'Editar Perfil - Cliente';

        // Verifica se o usuário está logado como Cliente
        if (!isset($_SESSION['userId']) || $_SESSION['userTipo'] !== 'Cliente') {
            $_SESSION['perfil-erro'] = 'Você precisa estar logado como cliente para acessar o perfil.';
            header('Location: ' . BASE_URL);
            exit;
        }

        // Carrega os dados do cliente
        $clienteModel = new Cliente();
        $dados['cliente'] = $clienteModel->buscarClientePorId($_SESSION['userId']);

        // Verifica se é uma requisição POST (formulário foi enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtra os dados do formulário
            $nome_cliente = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $senha_cliente = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_STRING);
            $tipo_cliente = filter_input(INPUT_POST, 'tipo_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cnpj_cliente = filter_input(INPUT_POST, 'cpf_cnpj_cliente', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_cliente = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_cliente = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nasc_cliente = filter_input(INPUT_POST, 'data_nasc_cliente', FILTER_SANITIZE_SPECIAL_CHARS);

            // Foto atual
            $foto_cliente = $dados['cliente']['foto_cliente'];

            // Verifica se há uma nova foto e faz o upload
            if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] == 0) {
                $foto_cliente = $this->uploadFoto($_FILES['foto_cliente'], $nome_cliente);
            }

            // Verifica se a foto foi carregada corretamente
            if (!$foto_cliente) {
                $_SESSION['mensagem'] = "Erro ao atualizar a foto do perfil";
                $_SESSION['tipo-msg'] = 'erro';
                header('Location: ' . BASE_URL . '/perfil/editar');
                exit;
            }

            // Dados para atualizar o cliente
            $dadosCliente = [
                'nome_cliente' => $nome_cliente,
                'telefone_cliente' => $telefone_cliente,
                'email_cliente' => $email_cliente,
                'senha_cliente' => $senha_cliente,  // Se necessário, aqui deve tratar a senha
                'tipo_cliente' => $tipo_cliente,
                'cpf_cnpj_cliente' => $cpf_cnpj_cliente,
                'endereco_cliente' => $endereco_cliente,
                'bairro_cliente' => $bairro_cliente,
                'cidade_cliente' => $cidade_cliente,
                'data_nasc_cliente' => $data_nasc_cliente,
                'foto_cliente' => $foto_cliente,
            ];

            // Atualiza os dados do cliente no banco
            if ($clienteModel->atualizarCliente($_SESSION['userId'], $dadosCliente)) {
                $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
                $_SESSION['tipo-msg'] = 'sucesso';
            } else {
                $_SESSION['mensagem'] = "Erro ao atualizar o perfil";
                $_SESSION['tipo-msg'] = 'erro';
            }

            // Carrega novamente a página de edição após o POST
            $dados['cliente'] = $clienteModel->buscarClientePorId($_SESSION['userId']);
        }
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
