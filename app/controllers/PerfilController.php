<?php

class PerfilController extends Controller{

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Perfil - Cliente';
        $this->carregarViews('perfil',$dados);
    }
}