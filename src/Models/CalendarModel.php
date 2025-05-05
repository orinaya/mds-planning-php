<?php

namespace App\Models;

use App\Utils\DataBase;
use PDO;

class CalendarModel
{
  public static function getStudentsCalendar(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson');
    $query->execute();
    $calendars = $query->fetchAll(PDO::FETCH_ASSOC);
    return $calendars;
  }

  public static function getClassCalendar(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson');
    $query->execute();
    $calendars = $query->fetchAll(PDO::FETCH_ASSOC);
    return $calendars;
  }

  public static function getLessonById($id): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public static function addLesson($lesson): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('INSERT INTO lesson (title, description, start_time, end_time) VALUES (:title, :description, :start_time, :end_time)');
    return $query->execute([
      ':title' => $lesson['title'],
      ':description' => $lesson['description'],
      ':start_time' => $lesson['start_time'],
      ':end_time' => $lesson['end_time']
    ]);
  }

  public static function updateLesson($lesson): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('UPDATE lesson SET title = :title, description = :description, start_time = :start_time, end_time = :end_time WHERE id = :id');
    return $query->execute([
      ':id' => $lesson['id'],
      ':title' => $lesson['title'],
      ':description' => $lesson['description'],
      ':start_time' => $lesson['start_time'],
      ':end_time' => $lesson['end_time']
    ]);
  }

  public static function deleteLesson($id): bool
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('DELETE FROM lesson WHERE id = :id');
    return $query->execute([':id' => $id]);
  }

  public static function getLessonsByDate($date): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson WHERE DATE(start_time) = :date');
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getLessonsByTeacher($teacherId): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson WHERE teacher_id = :teacher_id');
    $query->bindParam(':teacher_id', $teacherId, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function getLessonsByClass($classId): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson WHERE class_id = :class_id');
    $query->bindParam(':class_id', $classId, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getLessonsBySubject($subjectId): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson WHERE subject_id = :subject_id');
    $query->bindParam(':subject_id', $subjectId, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getLessonsByTime($startTime, $endTime): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson WHERE start_time >= :start_time AND end_time <= :end_time');
    $query->bindParam(':start_time', $startTime, PDO::PARAM_STR);
    $query->bindParam(':end_time', $endTime, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getLessonsByTeacherAndDate($teacherId, $date): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM lesson WHERE teacher_id = :teacher_id AND DATE(start_time) = :date');
    $query->bindParam(':teacher_id', $teacherId, PDO::PARAM_INT);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
