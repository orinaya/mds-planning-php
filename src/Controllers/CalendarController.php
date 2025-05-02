<?php

namespace App\Controllers;

class CalendarController extends MainController
{
  public function execute()
  {
    $this
      ->setView('calendar/index')
      ->setData([
        'title' => 'Planning général',
        'events' => []
      ])
      ->render();
  }
}
