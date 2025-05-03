<?php

namespace App\Controllers;

use App\Models\CalendarModel;
use App\Models\ModuleModel;

class CalendarController extends MainController
{
  public function execute()
  {
    $calendars = CalendarModel::getStudentsCalendar();
    $modules = ModuleModel::getAllModules();

    $this
      ->setView('calendar/index')
      ->setData([
        'title' => 'Planning des Étudiants 2024-2025',
        'calendars' => $calendars,
        'modules' => $modules,
      ])
      ->render();
  }
}
