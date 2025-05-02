<?php

namespace App\Controllers;

class TeachersController extends MainController
{
  public function execute()
  {
    $this
      ->setView('teachers/index')
      ->setData([
        'title' => 'Formateurs',
        'events' => []
      ])
      ->render();
  }
}
