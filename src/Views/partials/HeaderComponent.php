<?php
include_once(__DIR__ . '/BreadcrumbParticle.php');
function HeaderComponent($title, $showSearch = true, $buttons = [], $breadcrumbs = [])
{
  echo "<h1>" . htmlspecialchars($title) . "</h1>";

  if (!empty($breadcrumbs)) {
    BreadcrumbParticle($breadcrumbs);
  }

  echo '<div class="header"><div class="actions">';

  if ($showSearch) {
    echo '<input type="text" placeholder="Recherche" id="searchInput">';
  }

  foreach ($buttons as $button) {
    $label = $button['label'] ?? 'Bouton';
    $type = $button['type'] ?? 'primary';
    $icon = $button['icon'] ?? '';
    $action = $button['action'] ?? '';
    $method = $button['method'] ?? 'submit';

    ButtonParticle($label, $type, $icon, $action, $method);
  }

  echo '</div></div>';
}
