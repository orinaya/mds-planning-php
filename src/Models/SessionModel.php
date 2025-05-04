<?php

namespace App\Models;

use App\Utils\DataBase;
use PDO;

class SessionModel
{
  public static function getAllSessions(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM session');
    $query->execute();
    $sessions = $query->fetchAll(PDO::FETCH_ASSOC);
    return $sessions;
  }

  public static function getActiveSession(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM session WHERE is_active = 1');
    $query->execute();
    $activeSessions = $query->fetch(PDO::FETCH_ASSOC);
    return $activeSessions;
  }

  public static function getActiveSessionWithModulesByClasses(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('
    SELECT 
      session.id AS session_id,
      session.name AS session_name,
      session.created_at AS session_created_at,

      class.id AS class_id,
      class.nom AS class_name,
      class.id_grade AS grade_id,

      module.id AS module_id,
      module.nom AS module_name,
      module.duration,
      module.color,
      module.is_option,
      module.created_at AS module_created_at,

      teacher.id AS teacher_id,
      teacher.firstname AS teacher_firstname,
      teacher.lastname AS teacher_lastname,
      teacher.email AS teacher_email,

      lesson.id AS lesson_id,
      lesson.description AS lesson_description,
      lesson.date_start,
      lesson.date_end,
      lesson.is_hp

    FROM session

    LEFT JOIN module ON module.id_session = session.id

    LEFT JOIN class ON class.id = module.id_class

    LEFT JOIN module_teacher ON module_teacher.id_module = module.id
    LEFT JOIN teacher ON teacher.id = module_teacher.id_teacher

    LEFT JOIN lesson ON lesson.id_module = module.id

    WHERE session.is_active = 1
    ');
    $query->execute();
    $activeSessionWithModulesByClasses = $query->fetchAll(PDO::FETCH_ASSOC);
    return $activeSessionWithModulesByClasses;
  }

  public static function getSessionById(int $id): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM session WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $session = $query->fetch(PDO::FETCH_ASSOC);
    return $session;
  }
  public static function createSession(string $name, string $startDate, string $endDate): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('INSERT INTO session (name, start_date, end_date) VALUES (:name, :start_date, :end_date)');
    $query->bindParam(':name', $name);
    $query->bindParam(':start_date', $startDate);
    $query->bindParam(':end_date', $endDate);
    return $query->execute();
  }
  public static function updateSession(int $id, string $name, string $startDate, string $endDate): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('UPDATE session SET name = :name, start_date = :start_date, end_date = :end_date WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':name', $name);
    $query->bindParam(':start_date', $startDate);
    $query->bindParam(':end_date', $endDate);
    return $query->execute();
  }
  public static function deleteSession(int $id): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('DELETE FROM session WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
  }
  public static function activateSession(int $id): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('UPDATE session SET is_active = 1 WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
  }
  public static function deactivateSession(int $id): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('UPDATE session SET is_active = 0 WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
  }
}
