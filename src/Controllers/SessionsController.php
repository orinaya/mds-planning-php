<?php

namespace App\Controllers;

use App\Models\SessionModel;

class SessionsController extends MainController
{
  public function execute()
  {
    $sessions = SessionModel::getAllSessions();
    $activeSessions = SessionModel::getActiveSession();
    $activeSessionWithModulesByClasses = SessionModel::getActiveSessionWithModulesByClasses();
    $this
      ->setView('sessions/index')
      ->setData([
        'title' => 'Liste des années',
        'sessions' => $sessions,
        'activeSessions' => $activeSessions,
        'activeSessionWithModulesByClasses' => $activeSessionWithModulesByClasses
      ])
      ->render();
  }
}
