<?php

function InputParticle($config)
{
  $type = $config['type'] ?? 'text';
  $label = $config['label'] ?? '';
  $id = $config['id'] ?? '';
  $name = $config['name'] ?? $id;
  $placeholder = $config['placeholder'] ?? '';
  $value = $config['value'] ?? '';
  $required = !empty($config['required']) ? 'required' : '';
  $min = $config['min'] ?? '';
  $rows = $config['rows'] ?? 3;

  echo '<div class="form-group">';
  if ($type !== 'checkbox') {
    echo "<label for=\"$id\">$label</label>";
  }

  switch ($type) {
    case 'textarea':
      echo "<textarea id=\"$id\" name=\"$name\" class=\"form-control\" rows=\"$rows\" $required>$value</textarea>";
      break;

    case 'checkbox':
      echo "<label><input type=\"checkbox\" id=\"$id\" name=\"$name\" class=\"form-control\" $required> $label</label>";
      break;

    case 'color':
      echo "<input type=\"color\" id=\"$id\" name=\"$name\" class=\"form-control\" value=\"$value\">";
      break;

    case 'number':
      echo "<input type=\"number\" id=\"$id\" name=\"$name\" class=\"form-control\" value=\"$value\" min=\"$min\" $required>";
      break;

    case 'multi-select':
      echo <<<HTML
      <div id="classSelector" class="multi-select-container">
        <div id="multiSelect" class="multi-select"></div>
        <input type="text" id="classInput" class="form-control" placeholder="$placeholder" autocomplete="off" />
        <ul id="suggestions" class="suggestions-list"></ul>
        <input type="hidden" name="classes[]" id="selectedClasses" />
      </div>
      HTML;
      break;

    default:
      echo "<input type=\"$type\" id=\"$id\" name=\"$name\" class=\"form-control\" value=\"$value\" placeholder=\"$placeholder\" $required>";
      break;
  }

  echo '</div>';
}
