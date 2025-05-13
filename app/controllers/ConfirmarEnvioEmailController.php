<?php

class ConfirmarEnvioEmailController extends Controller{

    public function index(){
        $dados = array();

        $dados['mensagem'] = 'Confirmação Envio?';

        $this->carregarViews('confirmarEnvio',$dados);

    }
}