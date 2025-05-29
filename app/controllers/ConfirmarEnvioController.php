<?php

class ConfirmarEnvioController extends Controller{

    public function index(){

        $dados = array();

        $dados['titulo'] = 'Confirmação Envio?';

        $this->carregarViews('confirmarEnvio',$dados);

    }
}