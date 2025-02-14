<?php

class AuthController extends Controller
{

    public function login()
    {

        //var_dump("teste de login"); sempre testar para ver se  esta chegando na pagina //

        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha');
            $tipo_usuario = filter_input(INPUT_POST, 'tipo_usuario');


            if ($email && $senha && $tipo_usuario != "Selecione") {

                if ($tipo_usuario === 'Cliente') {
                    $usuarioModel = new Cliente();
                    $usuario = $usuarioModel->buscarCliente($email);
                    $campoSenha = 'senha_cliente';
                    $campoId = 'id_cliente';
                    $campoNome = 'nome_cliente';
                    // var_dump($usuario);

                } elseif ($tipo_usuario === 'Funcionario') {
                    $usuarioModel = new Funcionario();
                    $usuario = $usuarioModel->buscarFuncionario($email);


                    $campoSenha = 'senha_funcionario';
                    $campoId = 'id_funcionario';
                    $campoNome = 'nome_funcionario';
                    //  var_dump($usuario);
                } else {
                    $usuario = null;
                }


                if ($usuario && $usuario[$campoSenha] === $senha) {

                    // var_dump($usuario);
                    $_SESSION['userId'] = $usuario[$campoId];
                    $_SESSION['userTipo'] = $tipo_usuario;
                    $_SESSION['userNome'] = $usuario[$campoNome];

                    // var_dump($usuario);
                    header('Location:' . BASE_URL . 'dashboard');
                    exit;
                } else {
                    $_SESSION['login-erro'] = 'Email- ou Senha incorretos';
                }
            } else {

                $_SESSION['login-erro'] = 'Preencha todos os dados';
            }

            header('Location: ' . BASE_URL);
            exit;
        }

        header('Location: ' . BASE_URL);
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
