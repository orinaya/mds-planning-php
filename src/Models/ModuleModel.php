<?php

namespace App\Models;

use App\Utils\DataBase;
use PDO;

class ModuleModel
{
  public static function getAllModules(): array
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM module WHERE id_session = 1 ORDER BY name ASC');
    $query->execute();
    $modules = $query->fetchAll(PDO::FETCH_ASSOC);
    return $modules;
  }

  public function getModuleById($id)
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('SELECT * FROM modules WHERE id = :id');
    $query->execute(['id' => $id]);
    $modules = $query->fetchAll(PDO::FETCH_ASSOC);
    return $modules;
  }

  public function addModule($data)
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('
        INSERT INTO modules (id_class, id_session, name, description, duration, color, is_option, created_at, created_by, updated_at, updated_by)
        VALUES (:id_class, :id_session, :name, :description, :duration, :color, :is_option, NOW(), :created_by, NOW(), :updated_by)
    ');

    return $query->execute([
      'id_class' => $data['id_class'],
      'id_session' => $data['id_session'],
      'name' => $data['name'],
      'description' => $data['description'],
      'duration' => $data['duration'],
      'color' => $data['color'],
      'is_option' => $data['is_option'] ? 1 : 0,
      'created_by' => $data['user_id'],
      'updated_by' => $data['user_id']
    ]);
  }

  public function updateModule($id, $data)
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('
        UPDATE modules 
        SET id_class = :id_class, 
            id_session = :id_session, 
            name = :name, 
            description = :description, 
            duration = :duration, 
            color = :color, 
            is_option = :is_option, 
            updated_at = NOW(), 
            updated_by = :updated_by
        WHERE id = :id
    ');

    return $query->execute([
      'id' => $id,
      'id_class' => $data['id_class'],
      'id_session' => $data['id_session'],
      'name' => $data['name'],
      'description' => $data['description'],
      'duration' => $data['duration'],
      'color' => $data['color'],
      'is_option' => $data['is_option'] ? 1 : 0,
      'updated_by' => $data['user_id']
    ]);
  }

  public function deleteModule($id)
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('DELETE FROM modules WHERE id = :id');
    return $query->execute(['id' => $id]);
  }

  public function searchModules($term)
  {
    $dbh = DataBase::connectPDO();
    $query = $dbh->prepare('
        SELECT * FROM modules 
        WHERE name LIKE :term OR description LIKE :term
        ORDER BY name
    ');
    $query->execute(['term' => "%$term%"]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
