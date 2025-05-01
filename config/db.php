<?php
namespace App\Utils;
use PDO;
use PDOException;

class DataBase
{
  private $dbh;
  private static $_instance;
  private function __construct()
  {
    $configData = parse_ini_file('config.ini');

    try {
      $this->dbh = new PDO(
        "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
        $configData['DB_USERNAME'],
        $configData['DB_PASSWORD'],
      );
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      echo $e->getMessage() . '<br>';
      die;
    }
  }



  public static function connectPDO()
  {
    if (empty(self::$_instance)) {
      self::$_instance = new DataBase();
    }
    return self::$_instance->dbh;

  }
}