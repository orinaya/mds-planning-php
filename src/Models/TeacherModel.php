<?php

namespace App\Models;

use App\Utils\DataBase;
use PDO;

class TeacherModel
{
  public static function getAllTeachers(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM teacher');
    $query->execute();
    $teachers = $query->fetchAll(PDO::FETCH_ASSOC);
    return $teachers;
  }
}
