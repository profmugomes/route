<?php

/* Use as funções de exibição de erros somente em um servidor local */
error_reporting(E_ALL);
ini_set("display_errors", 1);

use Route\route;

include_once(dirname(__FILE__, 2) . '/vendor/autoload.php');

$route = new route();

if ($route->getURLs() == '') {
    echo 'Home Page';
} elseif ($route->getURLs() == 'categoria') {
    echo 'Página Categoria';
} elseif ($route->getURLs() == 'categoria/informatica') {
    echo 'Página Informática';
} else {
    echo 'Nenhuma página encontrada';
}