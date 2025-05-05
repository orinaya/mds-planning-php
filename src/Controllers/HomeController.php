<?php

namespace App\Controllers;

use App\Models\CalendarModel;
use App\Models\ClassModel;
use App\Models\ModuleModel;
use App\Models\TeacherModel;
use App\Models\SessionModel;

class HomeController extends MainController
{
  public function execute()
  {
    $calendars = CalendarModel::getStudentsCalendar();
    $modules = ModuleModel::getAllModules();
    $classes = ClassModel::getAllClasses();
    $teachers = TeacherModel::getAllTeachers();
    $sessions = SessionModel::getAllSessions();

    $this
      ->setView('home/index')
      ->setData([
        'title' => 'Accueil',
        'calendars' => $calendars,
        'modules' => $modules,
        'classes' => $classes,
        'teachers' => $teachers,
        'sessions' => $sessions,
      ])
      ->render();
  }
}
