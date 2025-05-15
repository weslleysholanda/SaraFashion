<?php

class Controller
{
    protected $userId;
    protected $usuario_logado;
    protected $usuario;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        // Verifica se o usuário está logado
        if (isset($_SESSION['userId'])) {
            $this->usuario_logado= true;
            $this->usuario = $_SESSION['userTipo'];
        } else {
            $this->usuario_logado = false;
        }

        // var_dump($_SESSION['usuario']);
        
        // $this->userId = $_SESSION['userId'] ?? null;
    }

    public function carregarViews($view, $dados = array())
    {
        $dados['usuario'] = $this->usuario_logado;
        extract($dados);

        require '../app/views/' . $view . '.php';
    }
}
