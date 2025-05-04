<?php
include_once('LinkParticle.php');
include_once('ButtonParticle.php');
?>

<section class="content">
  <h1><?= $title ?></h1>

  <div class="calendar-wrapper">
    <div id="calendar" class="calendar-container">

      <div class="calendar-header">
        <div>Lundi</div>
        <div>Mardi</div>
        <div>Mercredi</div>
        <div>Jeudi</div>
        <div>Vendredi</div>
      </div>

      <div class="calendar-body">
        <?php
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
        ?>

        <?php foreach ($weeks as $weekIndex => $days): ?>
          <div class="week">
            <?php foreach ($days as $dayIndex => $dayData): ?>
              <div class="day-column" id="day-<?= $weekIndex ?>-<?= $dayIndex ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
                <div class="day-name"><?= date('d/m/Y', $dayData['date']) ?></div>
                <div class="day-content">

                  <div class="calendar-half calendar-morning" id="morning-<?= $weekIndex ?>-<?= $dayIndex ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <?php foreach ($dayData['morning'] as $lesson): ?>
                      <div class="dropped-module" data-module-id="<?= $lesson['id'] ?>" draggable="true" ondragstart="drag(event)">
                        <?= htmlspecialchars($lesson['description']) ?>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <div class="calendar-half calendar-afternoon" id="afternoon-<?= $weekIndex ?>-<?= $dayIndex ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <?php foreach ($dayData['afternoon'] as $lesson): ?>
                      <div class="dropped-module" data-module-id="<?= $lesson['id'] ?>" draggable="true" ondragstart="drag(event)">
                        <?= htmlspecialchars($lesson['description']) ?>
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


    <div class="modules-container">
      <div class="modules-list">
        <h2>Liste des modules</h2>
        <?php ButtonParticle('Ajouter un module', 'primary', 'logout', 'addModuleBtn'); ?>
        <div class="search-bar">
          <input type="text" placeholder="Rechercher un module..." id="searchInput">
        </div>
        <ul id="modules">
          <?php foreach ($modules as $module): ?>
            <li class="module" id="module-<?= $module['id'] ?>" draggable="true" ondragstart="drag(event)" data-id="<?= $module['id'] ?>">
              <div class="color-primary">
                <div class="module-head">
                  <span class="module-title"> <?= htmlspecialchars($module['nom']) ?></span>
                  <span class="module-id">ID: <?= $module['id'] ?></span>
                </div>
                <div class="module-body">
                  <div class="module-duration"><?= $module['duration'] ?>h</div>
                  <div>Delai: 2</div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div id="moduleModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Ajouter un module</h3>
          <button class="close-btn">&times;</button>
        </div>
        <form id="moduleForm">

          <div class="form-group">
            <label for="classSelect">Classe(s)</label>
            <div id="classSelector" class="multi-select-container">
              <div id="multiSelect" class="multi-select"></div>
              <input type="text" id="classInput" class="form-control" placeholder="Rechercher une classe..." autocomplete="off" />
              <ul id="suggestions" class="suggestions-list"></ul>
              <input type="hidden" name="classes[]" id="selectedClasses" />
            </div>
          </div>

          <div class="form-group">
            <label for="moduleName">Nom du module</label>
            <input type="text" id="moduleName" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="moduleDescription">Description</label>
            <textarea id="moduleDescription" class="form-control" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="moduleDuration">Durée (heures)</label>
            <input type="number" id="moduleDuration" class="form-control" min="1" required>
          </div>
          <div class="form-group">
            <label for="moduleColor">Couleur</label>
            <input
              type="color"
              id="moduleColor"
              value="#007bff">
          </div>
          <div class=" form-group">
            <label>
              <input type="checkbox" id="moduleOption">
              Module optionnel
            </label>
          </div>
          <div class="form-actions">
            <?php ButtonParticle('Annuler', 'danger', 'trash-bin', 'cancelBtn'); ?>
            <?php ButtonParticle('Enregistrer', 'success', 'check', '', 'submit'); ?>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    const classes = <?php echo json_encode(array_column($classes, 'nom')); ?>;

    console.log(classes);
  </script>
</section>