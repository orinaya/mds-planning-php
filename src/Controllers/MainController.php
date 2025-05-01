<?php
namespace App\Controllers;
class MainController
{
  protected $view;
  protected $data;
  protected $classes;

  public function render()
  {
    $this->view = $this->getView();

    $base_uri = explode('/', $_SERVER['REQUEST_URI']);
    $data = $this->data;
    $classes = $this->classes;
    // Rendu de la vue avec les données récupérées
    require __DIR__ . '/../Views/layouts/sideBar.php';
    require __DIR__ . '/../Views/partials/' . $this->view . '.php';
    require __DIR__ . '/../Views/layouts/footer.php';
  }

  public function getView()
  {
    return $this->view;
  }

  public function setView($view): self
  {
    $this->view = $view;
    return $this;
  }

}