<?php

namespace App\Controllers;

class HomeController extends MainController
{
  public function execute()
  {
    $this
      ->setView('home/index')
      ->setData([
        'title' => 'Accueil',
        'events' => []
      ])
      ->render();
  }
}
