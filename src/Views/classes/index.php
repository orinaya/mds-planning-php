<?php include_once(__DIR__ . '/../partials/HeaderComponent.php'); ?>
<?php include_once(__DIR__ . '/../partials/TableComponent.php'); ?>

<section class="content">
  <?=

  HeaderComponent(
    $title,
    true,
    [
      ['label' => 'Ajouter une classe', 'type' => 'primary', 'icon' => 'add-circle', 'action' => 'classModal', 'method' => 'submit'],
      ['label' => 'Modifier les classes', 'type' => 'tertiary', 'icon' => 'folder', 'action' => '', 'method' => 'submit'],
    ],
    [
      ['label' => 'Accueil', 'url' => BASE_URL . '/'],
      ['label' => 'Année scolaire', 'url' => BASE_URL . '/classes'],
      ['label' => 'Liste des classes']
    ]
  );

  $columns = [
    'grade' => 'Niveau',
    'name' => 'Nom',
    'created_at' => 'Créé le'
  ];

  $rows = [];
  foreach ($classes as $class) {
    $grade = match ($class['id_grade']) {
      1 => 'BTS',
      2 => 'Bachelor 1',
      3 => 'Bachelor 2',
      4 => 'Bachelor 3',
      5 => 'MBA 1',
      6 => 'MBA 2',
      default => 'Inconnu',
    };

    $rows[] = [
      'grade' => $grade,
      'name' => $class['name'],
      'created_at' => $class['created_at']
    ];
  }

  TableComponent($columns, $rows, 'teacherTableBody');
  ?>


  <div id="classModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Ajouter une classe</h3>
        <button class="close-btn" id="closeClassModal">&times;</button>
      </div>
      <form id="classForm" method="POST" action="/classes/create">

        <div class="form-group">
          <label for="classGrade">Niveau (Grade)</label>
          <select id="classGrade" name="id_grade" class="form-control" required>
            <?php foreach ($grades as $grade): ?>
              <option value="<?= htmlspecialchars($grade['id']) ?>">
                <?= htmlspecialchars($grade['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="className">Nom de la classe</label>
          <input type="text" id="className" name="name" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="classDescription">Description</label>
          <textarea id="classDescription" name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-actions">
          <?php ButtonParticle('Annuler', 'danger', 'trash-bin', 'cancelClassBtn'); ?>
          <?php ButtonParticle('Enregistrer', 'success', 'check', '', 'submit'); ?>
        </div>

      </form>
    </div>
  </div>
  <script>
    document.getElementById("addClassBtn").addEventListener("click", () => {
      openGenericModal({
        title: "Ajouter une classe",
        icon: "school",
        bodyHtml: `
        <div class="form-group">
          <label for="className">Nom</label>
          <input type="text" name="name" id="className" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="classDescription">Description</label>
          <textarea name="description" id="classDescription" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="classGrade">Grade</label>
          <select name="id_grade" id="classGrade" class="form-control" required>
            <?php foreach ($grades as $grade): ?>
              <option value="<?= $grade['id'] ?>"><?= htmlspecialchars($grade['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      `,
        onSubmit: (formData) => {
          const name = formData.get("name");
          const idGrade = formData.get("id_grade");

          console.log("Ajout classe:", name, idGrade);

          const tbody = document.getElementById("teacherTableBody");
          const row = document.createElement("tr");
          row.innerHTML = `
          <td><input type="checkbox"></td>
          <td>${idGrade}</td>
          <td>${name}</td>
          <td>${new Date().toLocaleDateString()}</td>
        `;
          tbody.appendChild(row);
        }
      });
    });
  </script>
</section>