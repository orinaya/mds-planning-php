<?php

namespace App\Models;

use App\Utils\DataBase;
use PDO;

class GradeModel
{
  public static function getAllGrades(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM grade');
    $query->execute();
    $grades = $query->fetchAll(PDO::FETCH_ASSOC);
    return $grades;
  }

  public static function getGradeById(int $id): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM grade WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $grade = $query->fetch(PDO::FETCH_ASSOC);
    return $grade;
  }

  public static function updateGrade(int $id, string $name): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('UPDATE grade SET name = :name WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    return $query->execute();
  }

  public static function createGrade(string $name): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('INSERT INTO grade (name) VALUES (:name)');
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    return $query->execute();
  }

  public static function deleteGrade(int $id): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('DELETE FROM grade WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
  }
}
