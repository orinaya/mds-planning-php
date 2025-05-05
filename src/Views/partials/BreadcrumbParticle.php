<?php
function BreadcrumbParticle($paths = [])
{
  if (empty($paths)) return;

  echo '<nav class="breadcrumb">';
  $total = count($paths);
  foreach ($paths as $index => $item) {
    $label = htmlspecialchars($item['label']);
    $url = $item['url'] ?? null;

    if ($url && $index < $total - 1) {
      echo '<a href="' . htmlspecialchars($url) . '">' . $label . '</a> / ';
    } else {
      echo '<span>' . $label . '</span>';
    }
  }
  echo '</nav>';
}
