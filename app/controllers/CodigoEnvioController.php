<?php

class CodigoEnvioController extends controller{
    public function index(){
        $dados = array();

        $dados['mensagem'] = 'resetar senha';

        $this->carregarViews('codigoSenha',$dados);

    }
}