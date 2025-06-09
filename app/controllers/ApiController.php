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
        header("Access-Control-Allow-Origin: https://sarafashionapp.webdevsolutions.com.br");
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

        $_SESSION['preRegistro'] = [
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
        $dados["membro_desde"] = date('Y-m-d');
        $membroDesde = $dados["membro_desde"];

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


        $resultado = $this->clienteModel->cadastrarCliente($nome, $email, $senha, $membroDesde);

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

    //Atualizar Cliente
    public function atualizarCliente($id)
    {
        $cliente = $this->autenticarToken();

        if (!$cliente || $cliente['id_cliente'] != $id) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
            http_response_code(405);
            echo json_encode(['erro'  => 'Método não permitido.']);
            return;
        }

        $dados = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        if (!is_array($dados) || empty($dados)) {
            http_response_code(400);
            echo json_encode(['erro' => 'Nenhum dado enviado.']);
            return;
        }

        $dadosAtualizados = array_merge($cliente, $dados);


        if ($this->clienteModel->atualizarCliente($id, $dadosAtualizados)) {
            echo json_encode(['mensagem' => 'Dados atualizados com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao atualizar os dados.']);
        }
    }

    public function esqueceuSenha()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->liberarCORS();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido']);
            return;
        }

        $email = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
        if (!$email) {
            http_response_code(400);
            echo json_encode(['erro' => 'E-mail é obrigatório']);
            return;
        }

        $cliente = $this->clienteModel->buscarCliente($email);
        if (!$cliente) {
            http_response_code(404);
            echo json_encode(['erro' => 'E-mail não encontrado']);
            return;
        }

        // Gera token, expiração e código (string)
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+10 minutes'));
        $codigo = (string) rand(100000, 999999); // importante converter para string
        $codigoHash = password_hash($codigo, PASSWORD_DEFAULT);

        // Salva token, expiração e código hash
        $salvou = $this->clienteModel->salvarTokenRecuperacaoApp($cliente['id_cliente'], $token, $expira, $codigoHash);
        if (!$salvou) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao salvar token']);
            return;
        }

        // Enviar email com o código original (não o hash)
        require_once __DIR__ . '/../../vendors/phpmailer/src/PHPMailer.php';
        require_once __DIR__ . '/../../vendors/phpmailer/src/SMTP.php';
        require_once __DIR__ . '/../../vendors/phpmailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = HOST_EMAIL;
            $mail->SMTPAuth   = true;
            $mail->Username   = USER_EMAIL;
            $mail->Password   = PASS_EMAIL;
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = PORT_EMAIL;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom(USER_EMAIL, 'Sara Fashion');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de Senha - Sara Fashion';

            $nome = $cliente['nome_cliente'] ?? 'usuário';

            $mail->Body = "
            <div style='text-align: center; font-family: Trebuchet MS, Verdana, sans-serif;'>
                <div style='border: 2px solid #C59D5F; border-radius: 5px; padding: 40px; display: inline-block; background-color: #fff;'>
                    <div style='background-color: #C59D5F; padding: 10px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom:25px;'>
                        <img src='https://sarafashionapp.webdevsolutions.com.br/public/assets/img/logo_sarafashionEmail.png' style='width: 250px; object-fit: cover;' alt='logoSara'>
                    </div>

                    <h1 style='font-size: 1.563em; color: black;'>Olá, <strong>{$nome}</strong>!</h1>
                    <p style='color: black;'>Seu código de verificação é:</p>
                    <div>
                        <h2 style='color: #B8860B; font-size: 25px; font-weight: bold;'>{$codigo}</h2>
                    </div>
                    <p style='font-weight: bold; color: black;'>Válido por 10 minutos.</p>
                </div>
            </div>
        ";

            $mail->send();
            echo json_encode(['sucesso' => 'Código enviado por e-mail.', 'token' => $token]);
            // DICA: enviar o token junto para usar na API de validação
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao enviar e-mail: ' . $mail->ErrorInfo]);
        }
    }

    public function alterarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido']);
            exit;
        }

        session_start();
        $token = $_SESSION['recuperarSenha']['token'] ?? null;
        $novaSenha = $_POST['nova_senha'] ?? null;
        $confirmarSenha = $_POST['confirmar_senha'] ?? null;

        if (!$token || !$novaSenha || !$confirmarSenha) {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados insuficientes']);
            exit;
        }

        if ($novaSenha !== $confirmarSenha) {
            http_response_code(400);
            echo json_encode(['erro' => 'As senhas não conferem']);
            exit;
        }

        // Buscar cliente pelo token
        $cliente = $this->clienteModel->getClientePorToken($token);

        if (!$cliente) {
            http_response_code(401);
            echo json_encode(['erro' => 'Token inválido ou expirado']);
            exit;
        }

        // Validar se o token não expirou
        if (strtotime($cliente['token_expira']) < time()) {
            http_response_code(403);
            echo json_encode(['erro' => 'Token expirado']);
            exit;
        }

        // Hash da nova senha
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualizar senha
        $atualizou = $this->clienteModel->atualizarSenha($cliente['id_cliente'], $senhaHash);

        if (!$atualizou) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao atualizar a senha']);
            exit;
        }

        // Limpar token e código verificação
        $this->clienteModel->limparTokenRecuperacaoApp($cliente['id_cliente']);

        // Opcional: remover dados da sessão
        unset($_SESSION['recuperarSenha']);

        echo json_encode(['sucesso' => 'Senha alterada com sucesso']);
    }


    public function validarCodigoRecuperacao()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->liberarCORS();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $token = $_POST['token_recuperacao'] ?? '';
        $codigo = $_POST['codigo_verificacao'] ?? '';

        if (!$token || !$codigo) {
            http_response_code(400);
            echo json_encode(['erro' => 'Token e código são obrigatórios'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $cliente = $this->clienteModel->getClientePorToken($token);

        if (!$cliente) {
            http_response_code(401);
            echo json_encode(['erro' => 'Token inválido'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if (strtotime($cliente['token_expira']) < time()) {
            http_response_code(403);
            echo json_encode(['erro' => 'Token expirado'], JSON_UNESCAPED_UNICODE);
            return;
        }

        if (!password_verify($codigo, $cliente['codigo_verificacao'])) {
            http_response_code(401);
            echo json_encode(['erro' => 'Código incorreto'], JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode(['sucesso' => 'Código validado com sucesso'], JSON_UNESCAPED_UNICODE);
    }

    public function uploadFotoCliente($id)
    {
        $cliente = $this->autenticarToken();

        if (!$cliente || $cliente['id_cliente'] != $id) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro'  => 'Método não permitido.']);
            return;
        }

        if (!isset($_FILES['foto_cliente']) || empty($_FILES['foto_cliente']['name'])) {
            http_response_code(400);
            echo json_encode(['erro' => 'Nenhum arquivo enviado.']);
            return;
        }

        try {
            $foto = $this->uploadFoto($_FILES['foto_cliente'], $cliente['nome_cliente']);

            if ($foto) {
                $this->clienteModel->atualizarCliente($id, [
                    'foto_cliente' => $foto,
                    'alt_foto_cliente' => $cliente['nome_cliente']
                ]);

                echo json_encode(['mensagem' => 'Foto atualizada com sucesso.', 'caminho' => $foto]);
            } else {
                http_response_code(500);
                echo json_encode(['erro' => 'Erro ao salvar a foto.']);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['erro' => $e->getMessage()]);
        }
    }

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
