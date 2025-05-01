<?php
error_reporting(E_ERROR | E_PARSE);

require __DIR__ . '/vendor/autoload.php';
// var_dump(class_exists('App\Controllers\DashboardController'));
use \App\Router;


/**
 * Router
 */
$router = new Router();

try {
  $controller = $router->getController();
  $response = $controller->execute();
  http_response_code(200);
  echo $response;
  return $controller;

} catch (Exception $e) {
  http_response_code(404);
  echo "404 : La ressource demandée n'existe pas PROUT";
}
;