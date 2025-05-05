<?php

namespace App\Controllers;

class MainController
{
  protected $view;
  protected $data = [];
  protected $classes = [];

  public function render(): void
  {
    // Vérification des données
    if (!is_array($this->data)) {
      $this->data = [];
    }

    // Création de la vue, la sidebar et le layout en fonction de la vue actuelle
    $viewPath = __DIR__ . '/../Views/' . $this->view . '.php';
    $sidebarPath = __DIR__ . '/../Views/partials/sidebar.php';
    $layoutPath = __DIR__ . '/../Views/layouts/base.php';

    // Vérification de l'existence des fichiers de vue
    if (!file_exists($viewPath)) {
      throw new \Exception("Vue introuvable : {$this->view}");
    }

    extract($this->data);

    // Vérification de l'existence des fichiers de sidebar et de layout
    ob_start();
    include $sidebarPath;
    $sidebarContent = ob_get_clean();

    ob_start();
    include $viewPath;
    $viewContent = ob_get_clean();

    $content = function () use ($viewContent) {
      echo $viewContent;
    };

    include $layoutPath;
  }

  public function getView()
  {
    return $this->view;
  }

  public function setView(string $view): self
  {
    $this->view = $view;
    return $this;
  }

  public function setData(array $data = []): self
  {
    $this->data = $data;
    return $this;
  }
}
