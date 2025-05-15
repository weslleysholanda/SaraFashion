<?php

class Controller
{
    protected $userId;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userId = $_SESSION['userId'] ?? null;
    }

    public function carregarViews($view, $dados = array())
    {

        extract($dados);

        require '../app/views/' . $view . '.php';
    }
}
