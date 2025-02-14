<?php 


class LojaController extends Controller{
    private $produtoModel;
    public function __construct()
    {
        $this->produtoModel = new Produto();
    }

    public function index(){

        $dados = array();
        $dados['titulo'] = 'Loja - Sara Fashion';
        $dados['listarProduto'] = $this->produtoModel->getProduto();
        $this->carregarViews('loja',$dados);
    }

    public function detalhe($link){
        // var_dump($link);

        $dados = array();

        $detalheProduto = $this->produtoModel->getProdutoLink($link);

        if($detalheProduto != ""){
            $dados['titulo'] = $detalheProduto['nome_produto'];
            $dados['detalhe'] = $detalheProduto;
            $this->carregarViews('detalhe-produto',$dados);
        }else{
            $this->carregarViews('error404',$dados);
        }
    }
}