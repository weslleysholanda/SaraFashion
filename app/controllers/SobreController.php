<?php

class SobreController extends Controller{

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Sobre Nós - Sara Fashion';
        $this -> CarregarViews('sobre',$dados);
    }
}