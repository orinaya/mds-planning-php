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

  public static function getTeacherById(int $id): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM teacher WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $teacher = $query->fetch(PDO::FETCH_ASSOC);
    return $teacher;
  }

  public static function updateTeacher(int $id, string $firstname, string $lastname, string $email): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('UPDATE teacher SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    return $query->execute();
  }

  public static function createTeacher(string $firstname, string $lastname, string $email): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('INSERT INTO teacher (firstname, lastname, email) VALUES (:firstname, :lastname, :email)');
    $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    return $query->execute();
  }

  public static function deleteTeacher(int $id): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('DELETE FROM teacher WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
  }
}
