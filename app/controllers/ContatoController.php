<?php

use PHPMailer\PHPMailer\PHPMailer;

class ContatoController extends Controller
{
    private $dashboardModel;
    private $contatoModel;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->dashboardModel = new Dashboard();
        $this->contatoModel = new Contato();
    }
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Contato - Sara Fashion';
        $this->CarregarViews('contato', $dados);
    }

    public function enviarEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] = 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
            $tipoServico = filter_input(INPUT_POST, 'tipoServico', FILTER_SANITIZE_SPECIAL_CHARS);
            $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS);
            $assunto = 'Contato Via Site';

            // Envio do email
            if ($nome && $email && $tel && $tipoServico && $mensagem) {
                // instancia da model Contato
                $contatoModel = new Contato();

                $salvar = $contatoModel->salvarEmail($nome, $email, $tel, $tipoServico, $mensagem);

                if ($salvar) {
                    require_once('vendors/phpmailer/src/PHPMailer.php');
                    require_once('vendors/phpmailer/src/SMTP.php');
                    require_once('vendors/phpmailer/src/Exception.php');

                    $phpmail = new PHPMAILER();

                    try {
                        $phpmail->isSMTP();
                        $phpmail->SMTPDebug = 0;
                        $phpmail->Host = HOST_EMAIL;
                        $phpmail->Port = PORT_EMAIL;
                        $phpmail->SMTPSecure = 'ssl';
                        $phpmail->SMTPAuth = true;

                        $phpmail->Username = USER_EMAIL;
                        $phpmail->Password = PASS_EMAIL;

                        $phpmail->isHTML(true);
                        $phpmail->setFrom(USER_EMAIL, $nome); //Email Do remetente
                        $phpmail->addAddress(USER_EMAIL, $assunto);

                        $phpmail->Subject = $assunto;

                        //Estrutura do email
                        $phpmail->msgHtml("Nome: $nome <br>
                                          E-mail: $email <br>
                                          Telefone: $tel <br>
                                          Tipo de serviço: $tipoServico <br>
                                          Mensagem: $mensagem");
                        $phpmail->AltBody = "Nome: $nome   \n
                                            E-mail: $email \n
                                            Telefone: $tel  \n
                                            Tipo de serviço: $tipoServico\n
                                            Mensagem: $mensagem";
                        $phpmail->send();

                        $dados = array(
                            'mensagem' => 'Obrigado pelo seu contato, em breve responderemos',
                            'status' => 'sucesso'
                        );

                        $this->carregarViews('contato', $dados);

                        //Resposta do email
                        $phpmailResposta = new PHPMAILER;

                        $phpmailResposta->isSMTP();
                        $phpmailResposta->SMTPDebug = 0;
                        $phpmailResposta->Host = HOST_EMAIL;
                        $phpmailResposta->Port = PORT_EMAIL;
                        $phpmailResposta->SMTPSecure = 'ssl';
                        $phpmailResposta->SMTPAuth = true;
                        $phpmailResposta->Username = USER_EMAIL;
                        $phpmailResposta->Password = PASS_EMAIL;
                        $phpmailResposta->isHTML(true);
                        $phpmailResposta->setFrom(USER_EMAIL, 'Sara Fashion'); //Remetente
                        $phpmailResposta->addAddress($email, $nome); // Destinatário
                        $phpmailResposta->Subject = "Resposta - " . $assunto;

                        $phpmailResposta->msgHTML("$nome <br>
                                Em breve retornaremos seu contato. <br>
                                Mensagem: $mensagem <br>
                                Em caso de dúvidas entre em contato pelo número <br>
                               
                                (11)98361-2610");
                        $phpmailResposta->AltBody = "$nome \n
                                Em breve retornaremos seu contato. \n
                                Mensagem: $mensagem \n
                                Em caso de dúvidas entre em contato pelo número \n
                               
                                (11)98361-2610";
                        $phpmailResposta->send();
                    } catch (Exception $e) {
                        $dados = array(
                            'mensagem' => 'Não foi possível enviar o e-mail. Por favor, tente mais tarde',
                            'status' => 'erro',
                            'nome' => $nome,
                            'email' => $email,
                            'telefone' => $tel,
                            'Tipo de serviço' => $tipoServico,
                            'mensagem' => $mensagem
                        );

                        error_log('Erro ao enviar o e-mail' . $phpmail->ErrorInfo);
                    }
                }
            } else {
                $dados = array();
                $this->carregarViews('contato', $dados);
            }
            //---------teste captura--------------------
            // echo "Nome: $nome<br>";
            // echo "Email: $email<br>";
            // echo "Telefone: $tel<br>";
            // echo "Tipo de Serviço: $tipoServico<br>";
            // echo "Mensagem: $mensagem<br>";

        }
    }

    public function listar()
    {
        $dados = array();
        $dados['conteudo'] = 'dash/contato/listar';
        $dados['listarContato'] = $this->contatoModel->getListarContato();

        $dados['usuario'] = $this->dashboardModel->getUsuarioLogado($_SESSION['userId']);
        $dados['depoimento'] = $this->dashboardModel->getDepoimento();
        $dados['cadastro'] = $this->dashboardModel->getTotalRegistros();
        $dados['venda'] = $this->dashboardModel->getVendas();
        $this->carregarViews('dash/dashboard', $dados);
    }

    public function gerarLinkWhatsApp($id_contato)
    {
        // Obtém os dados do contato pelo ID
        $contato = $this->contatoModel->gerarLinkWhatsApp($id_contato);

        if ($contato) {
            // Remove caracteres não numéricos do telefone
            $telefone = preg_replace('/\D/', '', $contato['telefone_contato']);
            $mensagem = urlencode("Olá, {$contato['nome_contato']}! Obrigado pelo seu contato. Recebemos sua mensagem sobre '{$contato['assunto_contato']}'. Em breve entraremos em contato.");

            // Monta o link para o WhatsApp
            $linkWhatsApp = "https://api.whatsapp.com/send?phone=55{$telefone}&text={$mensagem}";

            // Redireciona para o WhatsApp
            header('Location: ' . $linkWhatsApp);
            exit;
        } else {
            $_SESSION['mensagem'] = "Contato não encontrado.";
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sarafashion/public/contato/listar');
            exit;
        }
    }
}
