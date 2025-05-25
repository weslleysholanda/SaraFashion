<?php

class ApiController extends Controller
{
    private $clienteModel;
    private $servicoModel;
    public function __construct()
    {
        $this->clienteModel = new Cliente();
        $this->servicoModel = new Servico();
    }
    /**
     * Da autorização para o dominio do app para fazer requisições POST
     */
    private function liberarCORS()
    {
        header("Access-Control-Allow-Origin: https://rrgarageapp.webdevsolutions.com.br");
        header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Credentials: true");

        // Se for preflight (OPTIONS), só responde e encerra
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204); // No Content
            exit;
        }
    }

    /**
     * Obtém o cabeçalho Authorization de forma segura
     */
    private function getAuthorizationHeader()
    {
        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['HTTP_AUTHORIZATION']);
        }

        if (!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
        }

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            foreach ($headers as $key => $value) {
                if (strtolower($key) === 'authorization') {
                    return trim($value);
                }
            }
        }

        return null;
    }

    /**
     * Valida e decodifica o token
     */
    private function autenticarToken()
    {
        try {
            $authHeader = $this->getAuthorizationHeader();

            if (!$authHeader || !preg_match('/Bearer\s+(.+)/', $authHeader, $matches)) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token não fornecido ou malformado.']);
                exit;
            }

            $token = trim($matches[1]);

            if (!$token || strpos($token, '.') === false) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token inválido ou incompleto.']);
                exit;
            }

            require_once 'core/TokenHelper.php';
            $TokenHelper = new TokenHelper();

            $dados = $TokenHelper::validar($token);

            if (!$dados || !isset($dados['id'], $dados['email'])) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token inválido ou expirado.']);
                exit;
            }

            $cliente = $this->clienteModel->buscarCliente($dados['email']);

            if (!$cliente || $cliente['id_cliente'] != $dados['id']) {
                http_response_code(403);
                echo json_encode(['erro' => 'Acesso negado.']);
                exit;
            }

            return $cliente;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro interno: ' . $e->getMessage()]);
            exit;
        }
    }

    /**
     * Endpoint de login que gera token
     */
    public function login()
    {
        $email = $_GET['email_cliente'] ?? null;
        $senha = $_GET['senha_cliente'] ?? null;

        if (!$email || !$senha) {
            http_response_code(400);
            echo json_encode(['erro' => 'E-mail ou senha são obrigatórios'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $cliente = $this->clienteModel->buscarCliente($email);

        if (!$cliente || !password_verify($senha, $cliente['senha_cliente'])) {
            http_response_code(401);
            echo json_encode(['erro' => 'E-mail ou senha inválidos'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $dadosToken = [
            'id'    => $cliente['id_cliente'],
            'email' => $cliente['email_cliente'],
            'exp'   => time() + (86400 * 30) // 30 dias de validade
        ];

        $token = TokenHelper::gerar($dadosToken);

        if (!class_exists('TokenHelper')) {
            die('TokenHelper não foi carregado!');
        }

        echo json_encode([
            'mensagem' => 'Login realizado com sucesso',
            'token'    => $token
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    //retornar dados do cliente

    public function cliente($id)
    {

        $cliente = $this->clienteModel->buscarClientePorId($id);

        if (!$cliente) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum cliente encontrado"]);
            exit;
        }

        echo json_encode($cliente);
    }


    public function fidelidadeCliente($id)
    {
        $fidelidade = $this->clienteModel->fidelidadeCliente($id);

        if (!$fidelidade) {
            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum cliente encontrado"]);
            exit;
        }

        echo json_encode($fidelidade);
    }

    //Listar Servico
    public function ListarServico()
    {
        $servico = $this->servicoModel->getServicoAll();

        if (empty($servico)) {
            http_response_code(404);
            echo json_encode(['mensagem' => "Nenhum registro encontrado"]);
            exit;
        }
        echo json_encode($servico, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
