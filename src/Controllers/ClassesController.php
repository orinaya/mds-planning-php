<?php

namespace App\Controllers;

class ClassesController extends MainController
{
  public function execute()
  {
    $this
      ->setView('classes/index')
      ->setData([
        'title' => 'Classes',
        'events' => []
      ])
      ->render();
  }
}
