<?php


namespace App;

use App\Controllers\ErrorController;
use Exception;

class Router
{
  public const ROUTES = [
    'GET' => [
      '/' => 'App\\Controllers\\HomeController',
      '/planning' => 'App\\Controllers\\CalendarController',
      '/classes' => 'App\\Controllers\\ClassesController',
      '/annees' => 'App\\Controllers\\SessionsController',
      '/formateurs' => 'App\\Controllers\\TeachersController'
    ]
  ];


  /**
   * Retourne la classe du contrôleur associée à la requête
   * @throws Exception  Si la méthode HTTP ou la route n'est pas définie ou aucun contrôleur n'est trouvé
   */
  public function getController()
  {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = str_replace('/mds-planning-php/public', '', $uri);

    $method = $_SERVER['REQUEST_METHOD'];

    if (!isset(self::ROUTES[$method])) {
      throw new Exception("Méthode HTTP non supportée : $method");
    }

    if (isset(self::ROUTES[$method][$uri])) {
      $controllerClass = self::ROUTES[$method][$uri];
    } else {
      $controller = new ErrorController();
      return function () use ($controller) {
        return $controller->notFound();
      };
    }

    if (!class_exists($controllerClass)) {
      throw new Exception("Contrôleur introuvable : $controllerClass");
    }

    return new $controllerClass();
  }
}
