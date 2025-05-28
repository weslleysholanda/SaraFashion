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
        try {
            $cliente = $this->autenticarToken();

            // Verifica se o token está válido e pertence ao cliente requisitado
            if (!$cliente || !isset($cliente['id_cliente']) || $cliente['id_cliente'] != $id) {
                http_response_code(403);
                echo json_encode(['erro' => 'Acesso negado.']);
                return;
            }

            // Busca os dados completos do cliente no banco (Com pré cadastro ou já cadastrado)
            $dados = $this->clienteModel->buscarClientePorId($id);

            if (!$dados) {
                http_response_code(404);
                echo json_encode(['erro' => 'Cliente não encontrado']);
                return;
            }

            echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'erro' => 'Erro interno no servidor',
                'detalhe' => $e->getMessage()
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
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

    //Cadastrar Cliente
    public function preCadastro()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido.']);
            return;
        }

        $dados = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        $nome  = filter_var(trim($dados['nome'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var(trim($dados['email'] ?? ''), FILTER_VALIDATE_EMAIL);
        $senha = trim($dados['senha'] ?? '');

        if (!$nome || !$email || !$senha) {
            http_response_code(400);
            echo json_encode(['erro' => 'Nome, e-mail e senha são obrigatórios.']);
            return;
        }

        if ($this->clienteModel->buscarCliente($email)) {
            http_response_code(409);
            echo json_encode(['erro' => 'Este e-mail já está em uso.']);
            return;
        }

        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        $_SESSION['pre_cadastro'] = [
            'nome'  => $nome,
            'email' => $email,
            'senha' => $senhaCriptografada
        ];

        echo json_encode([
            'mensagem' => 'Pré-cadastro salvo com sucesso. Agora selecione o método de verificação.'
        ]);
    }

    public function cadastrarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido.']);
            return;
        }

        $dados = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        date_default_timezone_set('America/Sao_Paulo');
        $dados["data_cadastro"] = date('Y-m-d');

        if (!is_array($dados) || empty($dados)) {
            http_response_code(400);
            echo json_encode(['erro' => 'Nenhum dado enviado.']);
            return;
        }

        $nome  = $dados['nome_cliente'] ?? null;
        $email = $dados['email_cliente'] ?? null;
        $senha = $dados['senha_cliente'] ?? null;

        if (!$nome || !$email || !$senha) {
            http_response_code(400);
            echo json_encode(['erro' => 'Nome, e-mail e senha são obrigatórios.']);
            return;
        }

        if ($this->clienteModel->buscarCliente($email)) {
            http_response_code(409);
            echo json_encode(['erro' => 'Este e-mail já está em uso.']);
            return;
        }

        // Criptografa a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Agora passa a senha criptografada para o model
        $resultado = $this->clienteModel->cadastrarCliente($nome, $email, $senhaCriptografada);

        if ($resultado) {
            // Buscar o cliente recém-cadastrado
            $cliente = $this->clienteModel->buscarCliente($email);

            $dadosToken = [
                'id'    => $cliente['id_cliente'],
                'email' => $cliente['email_cliente'],
                'exp'   => time() + (86400 * 30) // 30 dias
            ];

            if (!class_exists('TokenHelper')) {
                http_response_code(500);
                echo json_encode(['erro' => 'TokenHelper não carregado.']);
                return;
            }

            $token = TokenHelper::gerar($dadosToken);

            echo json_encode([
                'mensagem' => 'Cliente cadastrado com sucesso!',
                'token'    => $token
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao cadastrar o cliente.']);
        }
    }


    //fim cadastro cliente


    private function uploadFoto($file, $nome_cliente)
    {
        $dir = __DIR__ . '/../../uploads/cliente/';

        if (!file_exists(($dir))) {
            mkdir($dir, 0755, true);
        }

        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $extensoes_permitidas)) {
            throw new Exception('Tipo de arquivo não permitido.');
        }

        if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            // Gera um nome aleatório seguro
            $nome_cliente_formatado = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nome_cliente));
            $nome_arquivo = $nome_cliente_formatado . '_' . uniqid() . '.' . $ext;

            if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
                return 'cliente/' . $nome_arquivo;
            }
        }
        return false;
    }
}
