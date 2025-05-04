<section class="content">
  <h1><?= $title ?></h1>
  <div class="header">
    <div class="actions">
      <input type="text" placeholder="Recherche" id="searchInput">
      <?php ButtonParticle('Ajouter un formateur', 'primary', 'add-circle', '', 'submit'); ?>
      <?php ButtonParticle('Modifier les formateurs', 'tertiary', 'folder', '', 'submit'); ?>
    </div>
  </div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox"></th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody id="teacherTableBody">
        <?php foreach ($teachers as $teacher): ?>
          <tr>
            <td><input type="checkbox"></td>
            <td><?= htmlspecialchars($teacher['lastname']) ?></td>
            <td><?= htmlspecialchars($teacher['firstname']) ?></td>
            <td><?= htmlspecialchars($teacher['email']) ?></td>
            <td><?= htmlspecialchars($teacher['description']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</section>