<?php

namespace App\Controllers;

class MainController
{
  protected $view;
  protected $data = [];
  protected $classes = [];

  public function render(): void
  {
    if (!is_array($this->data)) {
      $this->data = [];
    }
    if (!is_array($this->classes)) {
      $this->classes = [];
    }

    $viewPath = __DIR__ . '/../Views/' . $this->view . '.php';
    $sidebarPath = __DIR__ . '/../Views/partials/sidebar.php';
    $layoutPath = __DIR__ . '/../Views/layouts/base.php';

    if (!file_exists($viewPath)) {
      throw new \Exception("Vue introuvable : {$this->view}");
    }

    extract($this->data);
    extract($this->classes);

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

  public function setClasses(array $classes = []): self
  {
    $this->classes = $classes;
    return $this;
  }
}
