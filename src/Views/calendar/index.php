<?php
include_once(__DIR__ . '/../partials/LinkParticle.php');
include_once(__DIR__ . '/../partials/ButtonParticle.php');
include_once(__DIR__ . '/../partials/HeaderComponent.php');
include_once(__DIR__ . '/../partials/InputParticle.php');

// Définition de la période scolaire
$startDate = strtotime('2024-09-02'); // début année 
$endDate = strtotime('2025-08-31');   // fin année

// Initialisation des semaines
$weeks = [];
$current = $startDate;
$weekIndex = 1;

// Semaines de l'année scolaire
while ($current <= $endDate) {
  $weeks[$weekIndex] = [];

  for ($dayIndex = 0; $dayIndex < 5; $dayIndex++) {
    $date = strtotime("+$dayIndex days", $current);
    $weeks[$weekIndex][$dayIndex] = [
      'date' => $date,
      'morning' => [],
      'afternoon' => []
    ];
  }

  $current = strtotime('+1 week', $current);
  $weekIndex++;
}

// évènements 
if (!empty($calendars)) {
  foreach ($calendars as $calendar) {
    $eventDate = strtotime($calendar['date_start']);
    foreach ($weeks as $wIndex => $days) {
      foreach ($days as $dIndex => $dayData) {
        if (date('Y-m-d', $dayData['date']) === date('Y-m-d', $eventDate)) {
          $isMorning = (date('H', $eventDate) < 12);
          $weeks[$wIndex][$dIndex][$isMorning ? 'morning' : 'afternoon'][] = $calendar;
        }
      }
    }
  }
}

function getModuleColor($modules, $moduleId)
{
  foreach ($modules as $mod) {
    if ($mod['id'] == $moduleId) {
      return $mod['color'];
    }
  }
  return '#ccc';
}
?>

<section class="content">
  <?= HeaderComponent(
    $title,
    true,
    [
      ['label' => 'Ajouter un cours', 'type' => 'primary', 'icon' => 'add-circle', 'action' => 'lessonModal', 'method' => 'submit'],
      ['label' => 'Modifier les cours', 'type' => 'tertiary', 'icon' => 'folder', 'action' => '', 'method' => 'submit'],
    ],
    [
      ['label' => 'Accueil', 'url' => BASE_URL . '/'],
      ['label' => 'Planification', 'url' => BASE_URL . '/planning'],
      ['label' => 'Planning Étudiants']
    ]
  ) ?>

  <div class="calendar-wrapper">
    <div id="calendar" class="calendar-container">

      <div class="calendar-header">
        <div>Lundi</div>
        <div>Mardi</div>
        <div>Mercredi</div>
        <div>Jeudi</div>
        <div>Vendredi</div>
      </div>

      <!-- Affichage du calendrier -->
      <div class="calendar-body">
        <!-- Affichage des semaines -->
        <?php foreach ($weeks as $weekIndex => $days): ?>
          <!-- Affichage de chaque semaine -->
          <div class="week">
            <?php foreach ($days as $dayIndex => $dayData): ?>
              <!-- Affichage de chaque jour -->
              <div
                class="day-column"
                id="day-<?= $weekIndex ?>-<?= $dayIndex ?>"
                ondrop="drop(event)"
                ondragover="allowDrop(event)">
                <div class="day-name">
                  <?= date('d/m/Y', $dayData['date']) ?>
                </div>
                <!-- Affichage de la matinée et de l'après-midi -->
                <div class="day-content">
                  <div
                    class="calendar-half calendar-morning"
                    id="morning-<?= $weekIndex ?>-<?= $dayIndex ?>"
                    ondrop="drop(event)"
                    ondragover="allowDrop(event)">
                    <?php foreach ($dayData['morning'] as $lesson): ?>
                      <?php $color = getModuleColor($modules, $lesson['id']); ?>
                      <div style="border: 2px solid <?= htmlspecialchars($color) ?>; border-radius: 8px; margin: 5px 0;">
                        <div
                          class="dropped-module"
                          data-module-id="<?= $lesson['id'] ?>"
                          draggable="true"
                          ondragstart="drag(event)"
                          style="border: 2px solid <?= htmlspecialchars($color) ?>; background-color: <?= htmlspecialchars($color) ?>; filter: brightness(1.3); border-radius: 8px; padding: 8px;">
                          <?= htmlspecialchars($lesson['description']) ?>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <div
                    class="calendar-half calendar-afternoon"
                    id="afternoon-<?= $weekIndex ?>-<?= $dayIndex ?>"
                    ondrop="drop(event)"
                    ondragover="allowDrop(event)">
                    <?php foreach ($dayData['afternoon'] as $lesson): ?>
                      <?php $color = getModuleColor($modules, $lesson['id']); ?>
                      <div style="border: 2px solid <?= htmlspecialchars($color) ?>; border-radius: 8px; margin: 5px 0;">
                        <div
                          class="dropped-module"
                          data-module-id="<?= $lesson['id'] ?>"
                          draggable="true"
                          ondragstart="drag(event)"
                          style="border: 2px solid <?= htmlspecialchars($color) ?>; background-color: <?= htmlspecialchars($color) ?>; filter: brightness(1.3); border-radius: 8px; padding: 8px;">
                          <?= htmlspecialchars($lesson['description']) ?>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Affichage de la liste des modules -->
    <div class="modules-container">
      <div class="modules-list">
        <h2>Liste des modules</h2>
        <?php
        ButtonParticle(
          'Ajouter un module',
          'primary',
          'add-circle',
          'addModuleBtn'
        );
        ?>
        <div class="search-bar">
          <input type="text" placeholder="Rechercher un module..." id="searchInput">
        </div>
        <ul id="modules">
          <?php foreach ($modules as $module): ?>
            <li
              class="module"
              style="border: 2px solid <?= htmlspecialchars($module['color']) ?>"
              id=" module-<?= $module['id'] ?>"
              draggable="true"
              ondragstart="drag(event)"
              data-id="<?= $module['id'] ?>">
              <div style="background-color: <?= htmlspecialchars($module['color']) ?>; filter: brightness(1.3); padding: 10px; border-radius: 8px;">
                <div class="module-head">
                  <span class="module-title">
                    <?= htmlspecialchars($module['name']) ?>
                  </span>
                  <span class="module-id">
                    ID: <?= $module['id'] ?>
                  </span>
                </div>
                <div class="module-body">
                  <div class="module-duration">
                    <span class="icon-clock"></span>
                    <?= $module['duration'] ?>h
                  </div>
                  <div>Delta: 2</div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <!-- Modal pour ajouter un module -->
    <div id="moduleModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Ajouter un module</h3>
          <button class="close-btn">&times;</button>
        </div>

        <form id="moduleForm">
          <?php
          InputParticle([
            'type' => 'multi-select',
            'label' => 'Classe(s)',
            'id' => 'classSelect',
            'placeholder' => 'Rechercher une classe...'
          ]);

          InputParticle([
            'type' => 'text',
            'label' => 'Nom du module',
            'id' => 'moduleName',
            'required' => true
          ]);

          InputParticle([
            'type' => 'textarea',
            'label' => 'Description',
            'id' => 'moduleDescription',
            'rows' => 3
          ]);

          InputParticle([
            'type' => 'number',
            'label' => 'Durée',
            'id' => 'moduleDuration',
            'min' => 1,
            'required' => true
          ]);

          InputParticle([
            'type' => 'color',
            'label' => 'Couleur',
            'id' => 'moduleColor',
            'value' => '#007bff'
          ]);

          InputParticle([
            'type' => 'checkbox',
            'label' => 'Module optionnel',
            'id' => 'moduleOption'
          ]);

          ?>

          <div class="form-actions">
            <?php ButtonParticle('Annuler', 'danger', 'trash-bin', 'cancelBtn'); ?>
            <?php ButtonParticle('Enregistrer', 'success', 'check', '', 'submit'); ?>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    const classes = <?php echo json_encode(array_column($classes, 'name')); ?>;
  </script>
</section>