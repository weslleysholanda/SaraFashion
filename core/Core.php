<?php 

class Core{
    //Método processo de Rotas
    public function executar(){

        $url = "/";
        // var_dump($url);

        if(isset($_GET['url'])){
           
            $url .= $_GET['url'];
            // var_dump($url);
        }

        //var_dump($url);

        //Definindo array armazem de url
        $parametro = array();

        //verificando se a url não está vazia
        if(!empty($url) && $url != '/'){

            $url = explode('/',$url);
            //var_dump($url);

            array_shift($url);
            // var_dump($url);

            $controladorAtual = ucfirst($url[0]).'Controller';
            // var_dump($controladorAtual);

            array_shift($url);

            if(isset($url[0]) && !empty($url[0])){
                $acaoAtual = $url[0];
                var_dump($acaoAtual);
                array_shift($url);
            }else{
                $acaoAtual = 'index';
            }


            if(count($url) > 0){
                $parametro = $url;
            }
        }else{
            $controladorAtual = 'HomeCOntroller';
            $acaoAtual = 'index';
        }

        // Verificando se o arquivo do CONTROLLER existe e se o metodo existe

        if (!file_exists('../app/controllers/' . $controladorAtual . '.php') || !method_exists($controladorAtual, $acaoAtual)){
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';
        }

        $controller = new $controladorAtual();

        call_user_func_array(array($controller,$acaoAtual),$parametro);
    }
}
?>