<?php

namespace App\Models;

use App\Utils\DataBase;
use PDO;

class ClassModel
{
  public static function getAllClasses(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM class');
    $query->execute();
    $classes = $query->fetchAll(PDO::FETCH_ASSOC);
    return $classes;
  }

  public static function getClassById(int $id): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM class WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $class = $query->fetch(PDO::FETCH_ASSOC);
    return $class;
  }

  public static function updateClass(int $id, string $name, int $gradeId): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('UPDATE class SET nom = :name, id_grade = :gradeId WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':gradeId', $gradeId, PDO::PARAM_INT);
    return $query->execute();
  }

  public static function createClass(string $name, int $gradeId): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('INSERT INTO class (nom, id_grade) VALUES (:name, :gradeId)');
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':gradeId', $gradeId, PDO::PARAM_INT);
    return $query->execute();
  }

  public static function deleteClass(int $id): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('DELETE FROM class WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
  }
}
