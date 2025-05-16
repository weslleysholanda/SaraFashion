<?php

class SobreController extends Controller{

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Sobre Nós - Sara Fashion';

        // $dados['usuario'] = $this->usuario_logado;
        // var_dump($dados['usuario']);

        $this -> CarregarViews('sobre',$dados);
    }
}