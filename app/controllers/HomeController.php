<?php 

class HomeController extends Controller{
    public function index(){
        $dados = array();

        $dados['mensagem'] = 'Bem-Vindo a SaraFashion';

        $marcasModel = new Marcas();
        $depoimentoModel = new Depoimento();

        // obter marcas logo
        $marcaLogo = $marcasModel ->getLogoNome();
        
        // Depoimento
        $depoimentoCliente = $depoimentoModel ->getDepoimentoCliente();

        $dados['marcaLogo'] = $marcaLogo;
        $dados['depoimentoCliente'] = $depoimentoCliente;


        $this->carregarViews('home',$dados);
    }       
}