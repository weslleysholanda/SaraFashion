<?php

class LoginController Extends Controller{

    public function index(){

        $dados = array();
        $dados['titulo']= 'Login - Sara Fashion';
        $this->carregarViews('login',$dados);
    }
}