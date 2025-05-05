<?php
function TableComponent(array $columns, array $rows, string $tbodyId = '', bool $selectable = true)
{
  echo '<div class="table-wrapper">';
  echo '<table>';

  // Header
  echo '<thead><tr>';
  if ($selectable) {
    echo '<th><input type="checkbox"></th>';
  }
  foreach ($columns as $column) {
    echo '<th>' . htmlspecialchars($column) . '</th>';
  }
  echo '</tr></thead>';

  // Body
  echo '<tbody' . ($tbodyId ? ' id="' . htmlspecialchars($tbodyId) . '"' : '') . '>';
  foreach ($rows as $row) {
    echo '<tr>';
    if ($selectable) {
      echo '<td><input type="checkbox"></td>';
    }
    foreach ($columns as $key => $label) {
      $value = $row[$key] ?? '';
      echo '<td>' . htmlspecialchars($value) . '</td>';
    }
    echo '</tr>';
  }
  echo '</tbody>';

  echo '</table>';
  echo '</div>';
}
