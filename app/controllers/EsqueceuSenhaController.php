<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EsqueceuSenhaController extends Controller
{
    private $clienteModel;
    public function __construct()
    {

        parent::__construct();
        $this->clienteModel = new Cliente();
    }
    public function index()
    {
        $dados = array();

        $dados['mensagem'] = 'Esqueceu a Senha?';

        $this->carregarViews('esqueceuSenha', $dados);
    }

    public function recuperarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);

            if (!$email) {
                http_response_code(400);
                echo json_encode(['erro' => 'O campo de e-mail é obrigatório']);
                exit;
            }

            $cliente = $this->clienteModel->buscarCliente($email);

            if (!$cliente) {
                http_response_code(400);
                echo json_encode(['erro' => 'E-mail não encontrado.']);
                exit;
            }

            // Gera token, salva no banco, envia e-mail...
            $token = bin2hex(random_bytes(32));
            $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $this->clienteModel->salvarTokenRecuperacao($cliente['id_cliente'], $token, $expira);

            require_once("vendors/phpmailer/src/PHPMailer.php");
            require_once("vendors/phpmailer/src/SMTP.php");
            require_once("vendors/phpmailer/src/Exception.php");

            $mail = new PHPMailer();

            try {
                $mail->isSMTP();
                $mail->Host       = HOST_EMAIL;
                $mail->Port       = PORT_EMAIL;
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Username   = USER_EMAIL;
                $mail->Password   = PASS_EMAIL;

                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';

                $mail->setFrom(USER_EMAIL, 'SaraFashion');
                $mail->addAddress($cliente['email_cliente'], $cliente['nome_cliente']);
                $mail->isHTML(true);
                $mail->Subject = 'Recuperação de Senha';

                $link = BASE_URL . 'recuperarSenha?token=' . $token;

                $mail->msgHTML("Olá {$cliente['nome_cliente']},<br><br>
                Clique no link abaixo para redefinir sua senha:<br><br>
                <a href='$link'>$link</a><br><br>
                Se você não fez essa solicitação, ignore este e-mail.");
                $mail->AltBody = "Olá {$cliente['nome_cliente']}, acesse $link para redefinir sua senha.";

                $mail->send();

                // Retorna sucesso (200) com mensagem para JS redirecionar
                http_response_code(200);
                echo json_encode(['sucesso' => 'E-mail enviado com sucesso.', 'redirect' => BASE_URL . 'confirmarEnvio']);
                exit;
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['erro' => 'Erro ao enviar e-mail: ' . $e->getMessage()]);
                exit;
            }
        }

        // Se não for POST, carrega a view normalmente (GET)
        $dados = ['mensagemErro' => ''];
        $this->carregarViews('esqueceuSenha', $dados);
    }
}
