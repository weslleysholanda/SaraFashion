<?php

class AuthController extends Controller
{

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha');
            $tipo_usuario = filter_input(INPUT_POST, 'tipo_usuario');

            if ($email && $senha && $tipo_usuario !== "Selecione") {
                if ($tipo_usuario === 'Cliente') {
                    $usuarioModel = new Cliente();
                    $usuario = $usuarioModel->buscarCliente($email);
                    $campoSenha = 'senha_cliente';
                    $campoId = 'id_cliente';
                    $campoNome = 'nome_cliente';
                    $redirect = 'perfil';
                } elseif ($tipo_usuario === 'Funcionario') {
                    $usuarioModel = new Funcionario();
                    $usuario = $usuarioModel->buscarFuncionario($email);
                    $campoSenha = 'senha_funcionario';
                    $campoId = 'id_funcionario';
                    $campoNome = 'nome_funcionario';
                    $redirect = 'dashboard';
                } else {
                    $_SESSION['login-erro'] = 'Tipo de usuário inválido.';
                    header('Location: ' . BASE_URL . 'login');
                    exit;
                }

                if ($usuario && $usuario[$campoSenha] === $senha) {
                    $_SESSION['userId'] = $usuario[$campoId];
                    $_SESSION['userTipo'] = $tipo_usuario;
                    $_SESSION['userNome'] = $usuario[$campoNome];

                    header('Location: ' . BASE_URL . $redirect);
                    exit;
                } else {
                    $_SESSION['login-erro'] = 'Email ou senha incorretos.';
                }
            } else {
                $_SESSION['login-erro'] = 'Preencha todos os campos.';
            }

            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        header('Location: ' . BASE_URL . 'login');
        exit;
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($nome && $email && $senha) {
                $clienteModel = new Cliente();

                if (!$clienteModel->buscarCliente($email)) {
                    $clienteModel->cadastrarCliente($nome, $email, $senha, 'Ativo');

                    $cliente = $clienteModel->buscarCliente($email);
                    $_SESSION['userId'] = $cliente['id_cliente'];
                    $_SESSION['userTipo'] = 'Cliente';
                    $_SESSION['userNome'] = $cliente['nome_cliente'];


                    header('Location: ' . BASE_URL . 'perfil');
                    exit;
                } else {
                    $_SESSION['cadastro-erro'] = 'Este email já está em uso.';
                }
            } else {
                $_SESSION['cadastro-erro'] = 'Por favor, preencha todos os campos.';
            }
        }

        header('Location: ' . BASE_URL . 'login');
        exit;
    }

    public function sair()
    {
        //libera todas as variáveis ​​de sessão atualmente registradas.
        session_unset();
        // destrói todos os dados associados à sessão atual.
        session_destroy();
        header('Location:' . BASE_URL);
        exit;
    }

}
