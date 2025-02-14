<?php

class Core
{
    //Método processo de Rotas
    public function executar()
    {
        $url = "/";

        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        // Verifica se a URL corresponde à rota personalizada
        if (preg_match('/\/contato\/whatsapp\/(\d+)/', $url, $matches)) {
            $id_contato = $matches[1];
            $controller = new ContatoController();
            $controller->gerarLinkWhatsApp($id_contato);
            exit; // Encerra o script para evitar processamento adicional
        }

        // Definição de variáveis para controlador, ação e parâmetros
        $parametro = array();

        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);

            $controladorAtual = ucfirst($url[0]) . 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $acaoAtual = $url[0];
                array_shift($url);
            } else {
                $acaoAtual = 'index';
            }

            if (count($url) > 0) {
                $parametro = $url;
            }
        } else {
            $controladorAtual = 'HomeController';
            $acaoAtual = 'index';
        }

        // Verificação se o controlador e método existem
        if (!file_exists('../app/controllers/' . $controladorAtual . '.php') || !method_exists($controladorAtual, $acaoAtual)) {
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';
        }

        $controller = new $controladorAtual();
        call_user_func_array(array($controller, $acaoAtual), $parametro);
    }
}
