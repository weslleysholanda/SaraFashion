<?php

class EsqueceuSenhaController extends Controller
{
    public function index()
    {
        $dados = array();

        $dados['mensagem'] = 'Esqueceu a Senha?';

        $this->carregarViews('esqueceuSenha', $dados);
    }
}
