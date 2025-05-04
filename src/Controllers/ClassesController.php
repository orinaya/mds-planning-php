<?php

namespace App\Controllers;

use App\Models\ClassModel;

class ClassesController extends MainController
{
  public function execute()
  {

    $classes = ClassModel::getAllClasses();

    $this
      ->setView('classes/index')
      ->setData([
        'title' => 'Liste des classes',
        'classes' => $classes
      ])
      ->render();
  }
}
