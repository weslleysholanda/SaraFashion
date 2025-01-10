<?php

class ServicoController extends Controller{

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Serviços - Sara Fashion';
        $this->carregarViews('servico',$dados);
    }
}