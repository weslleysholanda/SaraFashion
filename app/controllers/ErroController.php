<?php

class ErroController extends Controller{

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Erro 404 - Sara Fashion';
        $this->CarregarViews('error404', $dados);
    }
}