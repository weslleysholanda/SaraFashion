<?php 

class ContatoController extends Controller{

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Contato - Sara Fashion';
        $this -> CarregarViews('contato',$dados);
    }
}