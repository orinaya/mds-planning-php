<?php

namespace App\Controllers;

use App\Models\TeacherModel;

class TeachersController extends MainController
{
  public function execute()
  {
    $teachers = TeacherModel::getAllTeachers();
    $this
      ->setView('teachers/index')
      ->setData([
        'title' => 'Liste des formateurs',
        'teachers' => $teachers
      ])
      ->render();
  }
}
