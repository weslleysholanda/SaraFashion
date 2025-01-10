<?php 


class LojaController extends Controller{

    public function index(){

        $dados = array();
        $dados['titulo'] = 'Loja - Sara Fashion';

        $this->carregarViews('loja',$dados);
    }
}