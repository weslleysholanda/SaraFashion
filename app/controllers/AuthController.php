<?php

class AuthController extends Controller
{

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha');

            if ($email && $senha) {
                $clienteModel = new Cliente();
                $cliente = $clienteModel->buscarCliente($email);

                if ($cliente && password_verify($senha, $cliente['senha_cliente'])) {
                    $_SESSION['userId'] = $cliente['id_cliente'];
                    $_SESSION['userTipo'] = 'Cliente';
                    $_SESSION['userNome'] = $cliente['nome_cliente'];
                    $_SESSION['userFoto'] = $cliente['foto_cliente'];
                    header('Location: ' . BASE_URL . 'perfil');
                    exit;
                }

                $funcionarioModel = new Funcionario();
                $funcionario = $funcionarioModel->buscarFuncionario($email);

                if ($funcionario && password_verify($senha, $funcionario['senha_funcionario'])) {
                    $_SESSION['userId'] = $funcionario['id_funcionario'];
                    $_SESSION['userTipo'] = 'Funcionario';
                    $_SESSION['userNome'] = $funcionario['nome_funcionario'];
                    $_SESSION['userFoto'] = $funcionario['foto_funcionario'];
                    header('Location: ' . BASE_URL . 'dashboard');
                    exit;
                }

                // Se nenhum login der certo
                $_SESSION['login-erro'] = 'Email ou senha incorretos.';
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
