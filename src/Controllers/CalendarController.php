<?php

namespace App\Controllers;

use App\Models\CalendarModel;
use App\Models\ClassModel;
use App\Models\ModuleModel;
use App\Models\SessionModel;

class CalendarController extends MainController
{
  public function execute()
  {
    $calendars = CalendarModel::getStudentsCalendar();
    $modules = ModuleModel::getAllModules();
    $classes = ClassModel::getAllClasses();
    $activeSessions = SessionModel::getActiveSession();

    $this
      ->setView('calendar/index')
      ->setData([
        'title' => 'Planning des Étudiants ' . $activeSessions['name'],
        'calendars' => $calendars,
        'modules' => $modules,
        'classes' => $classes,
        'activeSessions' => $activeSessions,
      ])
      ->render();
  }
}
