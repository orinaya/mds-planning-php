<?php include_once(__DIR__ . '/../partials/HeaderComponent.php'); ?>

<section class="content">
  <?= HeaderComponent(
    $title,
    true,
    [
      ['label' => 'Ajouter une année', 'type' => 'primary', 'icon' => 'add-circle', 'action' => 'addSessionModal', 'method' => 'submit'],
      ['label' => 'Modifier les années', 'type' => 'tertiary', 'icon' => 'folder', 'action' => '', 'method' => 'submit'],
    ],
    [
      ['label' => 'Accueil', 'url' => BASE_URL . '/'],
      ['label' => 'Année scolaire', 'url' => BASE_URL . '/annees'],
      ['label' => 'Liste des années']
    ]
  ) ?>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox"></th>
          <th>Année</th>
          <th>Statut</th>
          <th>Créé le</th>
        </tr>
      </thead>
      <tbody id="teacherTableBody">
        <?php foreach ($sessions as $session): ?>
          <tr>
            <?php
            $active = match ($session['is_active']) {
              0 => 'Inactive',
              1 => 'En cours',
              default => 'Statut inconnu',
            };
            ?>
            <td><input type="checkbox"></td>
            <td><?= htmlspecialchars($session['name']) ?></td>
            <td><?= htmlspecialchars($active) ?></td>
            <td><?= htmlspecialchars($session['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php
  $organizedSessions = [];

  foreach ($activeSessionWithModulesByClasses as $row) {
    $sessionId = $row['session_id'];
    $classId = $row['class_id'];
    $moduleId = $row['module_id'];
    $teacherId = $row['teacher_id'];
    $lessonId = $row['lesson_id'];

    if (!isset($organizedSessions[$sessionId])) {
      $organizedSessions[$sessionId] = [
        'id' => $sessionId,
        'name' => $row['session_name'],
        'created_at' => $row['session_created_at'],
        'classes' => [],
      ];
    }

    if ($classId && !isset($organizedSessions[$sessionId]['classes'][$classId])) {
      $organizedSessions[$sessionId]['classes'][$classId] = [
        'id' => $classId,
        'name' => $row['class_name'],
        'grade_id' => $row['grade_id'] ?? null,
        'modules' => [],
      ];
    }

    if ($moduleId && !isset($organizedSessions[$sessionId]['classes'][$classId]['modules'][$moduleId])) {
      $organizedSessions[$sessionId]['classes'][$classId]['modules'][$moduleId] = [
        'id' => $moduleId,
        'name' => $row['module_name'],
        'color' => $row['color'],
        'is_option' => $row['is_option'],
        'teachers' => [],
        'lessons' => [],
      ];
    }

    if ($teacherId && !isset($organizedSessions[$sessionId]['classes'][$classId]['modules'][$moduleId]['teachers'][$teacherId])) {
      $organizedSessions[$sessionId]['classes'][$classId]['modules'][$moduleId]['teachers'][$teacherId] = [
        'id' => $teacherId,
        'firstname' => $row['teacher_firstname'],
        'lastname' => $row['teacher_lastname'],
        'email' => $row['teacher_email'],
      ];
    }

    if ($lessonId && !isset($organizedSessions[$sessionId]['classes'][$classId]['modules'][$moduleId]['lessons'][$lessonId])) {
      $organizedSessions[$sessionId]['classes'][$classId]['modules'][$moduleId]['lessons'][$lessonId] = [
        'id' => $lessonId,
        'description' => $row['lesson_description'],
        'date_start' => $row['date_start'],
        'date_end' => $row['date_end'],
        'is_hp' => $row['is_hp'],
      ];
    }
  }
  ?>


  <div>
    <?php foreach ($organizedSessions as $session): ?>
      <div class="session">
        <h2>Année en cours : <?= htmlspecialchars($session['name']) ?></h2>

        <?php foreach ($session['classes'] as $class): ?>
          <?php
          $grade = match ($class['grade_id']) {
            1 => 'BTS',
            2 => 'Bachelor 1',
            3 => 'Bachelor 2',
            4 => 'Bachelor 3',
            5 => 'MBA 1',
            6 => 'MBA 2',
            default => 'Inconnu',
          };
          ?>
          <button class="accordion-toggle"><?= $grade ?> - <?= htmlspecialchars($class['name']) ?></button>
          <div class="accordion-content">

            <?php foreach ($class['modules'] as $module): ?>
              <button class="accordion-toggle">
                Module : <?= htmlspecialchars($module['name']) ?><?= $module['is_option'] ? ' (Option)' : '' ?>
              </button>
              <div class="accordion-content" style="border-left: 5px solid <?= htmlspecialchars($module['color'] ?? '#ccc') ?>;">

                <?php if (!empty($module['teachers'])): ?>
                  <p><strong>Enseignants :</strong></p>
                  <ul>
                    <?php foreach ($module['teachers'] as $teacher): ?>
                      <li><?= htmlspecialchars($teacher['firstname'] . ' ' . $teacher['lastname']) ?> (<?= htmlspecialchars($teacher['email']) ?>)</li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>

                <?php if (!empty($module['lessons'])): ?>
                  <p><strong>Cours :</strong></p>
                  <ul>
                    <?php foreach ($module['lessons'] as $lesson): ?>
                      <li>
                        <?= htmlspecialchars($lesson['description']) ?> —
                        du <?= htmlspecialchars($lesson['date_start']) ?> au <?= htmlspecialchars($lesson['date_end']) ?>
                        <?= $lesson['is_hp'] ? '(HP)' : '' ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>

              </div>
            <?php endforeach; ?>

          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <style>
    .accordion-toggle {
      cursor: pointer;
      background-color: #f1f1f1;
      padding: 10px;
      border: none;
      width: 100%;
      text-align: left;
      font-weight: bold;
      transition: 0.3s;
    }

    .accordion-content {
      display: none;
      padding: 10px 20px;
      border-left: 2px solid #ccc;
      margin-bottom: 10px;
      background-color: #fafafa;
    }

    .accordion-content.show {
      display: block;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const toggles = document.querySelectorAll('.accordion-toggle');
      toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
          const content = toggle.nextElementSibling;
          content.classList.toggle('show');
        });
      });
    });
  </script>
</section>