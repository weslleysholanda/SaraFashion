<?php
 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Definir url base da aplicação
// define("BASE_URL","https://sarafashion.smpsistema.com.br/");
define('BASE_URL', 'http://localhost/sarafashion/public/');
 
 
//Acesso Banco e dados
define("DB_HOST", "webdevsolutions.com.br"); //Host do sistemas
define("DB_NAME", "u230564252_sarafashion"); //Nome da data base
define("DB_USER", "u230564252_sarafashion"); //Usuario
define("DB_PASS", "Senac@sarafashion01");
 
 
//Config Envio de email
define("HOST_EMAIL", "smtp.gmail.com");
define("PORT_EMAIL", "465");
define("USER_EMAIL", "weslleyh98@gmail.com");
define("PASS_EMAIL", "vjdk ikqa aoda cpjz");
 
//Autoload Classe
spl_autoload_register(function ($classe) {
    if (file_exists('../app/controllers/' . $classe . '.php')) {
        require_once '../app/controllers/' . $classe . '.php';
    }
 
    if (file_exists('../app/models/' . $classe . '.php')) {
        require_once '../app/models/' . $classe . '.php';
    }
 
    if (file_exists('../core/' . $classe . '.php')) {
        require_once '../core/' . $classe . '.php';
    }
});