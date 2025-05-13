<?php

class ConfirmarEnvioController extends Controller{

    public function index(){
        $dados = array();

        $dados['mensagem'] = 'Confirmação Envio?';

        $this->carregarViews('confirmarEnvio',$dados);

    }
}