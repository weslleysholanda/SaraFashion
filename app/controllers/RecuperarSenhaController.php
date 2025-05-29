<?php

class RecuperarSenhaController extends Controller
{
    private $clienteModel;
    public function __construct()
    {

        parent::__construct();
        $this->clienteModel = new Cliente();
    }

    public function index()
    {
        $token = filter_input(INPUT_GET, 'token', FILTER_UNSAFE_RAW);

        if (!$token || !preg_match('/^[a-f0-9]{64}$/', $token)) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $dados = [
            'titulo' => 'Redefinir Senha',
            'token' => $token
        ];

        $this->carregarViews('recuperarSenha', $dados);
    }


    public function resetarSenha()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['erro' => 'Requisição inválida']);
            return;
        }

        $token = filter_input(INPUT_POST, 'token', FILTER_UNSAFE_RAW);
        $novaSenha = filter_input(INPUT_POST, 'nova_senha', FILTER_UNSAFE_RAW);

        // Valida token
        if (!$token || !preg_match('/^[a-f0-9]{64}$/', $token)) {
            echo json_encode(['erro' => 'Token inválido ou ausente']);
            return;
        }

        // Valida senha
        if (!$novaSenha || strlen($novaSenha) < 6) {
            echo json_encode(['erro' => 'A senha deve ter ao menos 6 caracteres']);
            return;
        }

        // Busca cliente pelo token
        $cliente = $this->clienteModel->getClientePorToken($token);

        if (!$cliente || strtotime($cliente['token_expira']) < time()) {
            echo json_encode(['erro' => 'Token inválido ou expirado']);
            return;
        }

        // Faz hash e atualiza
        $senhaHashed = password_hash($novaSenha, PASSWORD_DEFAULT);
        $atualizado = $this->clienteModel->atualizarSenha($cliente['id_cliente'], $senhaHashed);

        if ($atualizado) {
            $this->clienteModel->limparTokenRecuperacao($cliente['id_cliente']);
            echo json_encode(['sucesso' => 'Senha redefinida com sucesso']);
        } else {
            echo json_encode(['erro' => 'Erro ao atualizar a senha']);
        }
    }
}
