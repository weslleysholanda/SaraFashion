<?php

class CarrinhoController extends Controller{

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Carrinho - Sara Fashion';
        $this->CarregarViews('carrinho', $dados);
    }
}