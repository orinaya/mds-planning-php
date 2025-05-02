<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';
// var_dump(class_exists('App\Controllers\DashboardController'));
use \App\Router;
use App\Controllers\ErrorController;

define('BASE_URL', '/mds-planning-php/public');
/**
 * Router
 */
$router = new Router();

try {
  // Récupérer le contrôleur via le routeur
  $controller = $router->getController();

  if (method_exists($controller, 'execute')) {
    $response = $controller->execute();
    http_response_code(200);
    echo $response;
  } else {
    throw new Exception("La méthode 'execute' est introuvable dans le contrôleur.");
  }
} catch (Exception $e) {
  http_response_code(404);

  if (getenv('APP_ENV') === 'dev') {
    echo "<h1>Erreur</h1><p>{$e->getMessage()}</p>";
  } else {
    $errorController = new ErrorController();
    echo $errorController->notFound();
  }
}
