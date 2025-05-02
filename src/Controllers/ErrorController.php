<?php

namespace App\Controllers;

class ErrorController
{
  public function notFound()
  {
    return "<h1>404 - Page non trouvée</h1><p>La ressource que vous cherchez n'existe pas.</p>";
  }
}
