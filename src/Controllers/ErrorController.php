<?php

namespace App\Controllers;

class ErrorController
{
  private $view;
  private $data;

  public function setView($view)
  {
    $this->view = $view;
    return $this;
  }

  public function setData(array $data)
  {
    $this->data = $data;
    return $this;
  }

  public function render()
  {

    echo "Rendering view: {$this->view} with data: " . json_encode($this->data);
  }

  public function notFound()
  {
    $this
      ->setView('errors/404')
      ->setData([
        'title' => 'Page non trouvée',
        'message' => "La ressource que vous cherchez n'existe pas.",
      ])
      ->render();
  }
}
