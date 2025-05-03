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
}
