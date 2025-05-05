<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\GradeModel;

class ClassesController extends MainController
{
  public function execute()
  {

    $classes = ClassModel::getAllClasses();
    $grades = GradeModel::getAllGrades();
    $this
      ->setView('classes/index')
      ->setData([
        'title' => 'Liste des classes',
        'classes' => $classes,
        'grades' => $grades
      ])
      ->render();
  }
}
