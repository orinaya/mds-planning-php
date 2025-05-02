<?php

namespace App\Controllers;

class SessionsController extends MainController
{
  public function execute()
  {
    $this
      ->setView('sessions/index')
      ->setData([
        'title' => 'Sessions',
        'events' => []
      ])
      ->render();
  }
}
