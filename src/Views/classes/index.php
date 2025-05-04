<section class="content">
  <h1><?= $title ?></h1>
  <div class="header">
    <div class="actions">
      <input type="text" placeholder="Recherche" id="searchInput">
      <?php ButtonParticle('Ajouter une classe', 'primary', 'add-circle', '', 'submit'); ?>
      <?php ButtonParticle('Modifier les classes', 'tertiary', 'folder', '', 'submit'); ?>
    </div>
  </div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox"></th>
          <th>Niveau</th>
          <th>Nom</th>
          <th>Créé le</th>
        </tr>
      </thead>
      <tbody id="teacherTableBody">
        <?php foreach ($classes as $class): ?>
          <tr>
            <?php
            $grade = match ($class['id_grade']) {
              1 => 'BTS',
              2 => 'Bachelor 1',
              3 => 'Bachelor 2',
              4 => 'Bachelor 3',
              5 => 'MBA 1',
              6 => 'MBA 2',
              default => 'Inconnu',
            };
            ?>
            <td><input type="checkbox"></td>
            <td><?= htmlspecialchars($grade) ?></td>
            <td><?= htmlspecialchars($class['nom']) ?></td>
            <td><?= htmlspecialchars($class['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</section>