<?php include_once(__DIR__ . '/../partials/HeaderComponent.php'); ?>

<section class="content">
  <?= HeaderComponent(
    $title,
    true,
    [
      ['label' => 'Ajouter un formateur', 'type' => 'primary', 'icon' => 'add-circle', 'action' => 'addTeacherModal', 'method' => 'submit'],
      ['label' => 'Modifier les formateurs', 'type' => 'tertiary', 'icon' => 'folder', 'action' => '', 'method' => 'submit'],
    ],
    [
      ['label' => 'Accueil', 'url' => BASE_URL . '/'],
      ['label' => 'Formateurs', 'url' => BASE_URL . '/formateurs'],
      ['label' => 'Liste des formateurs']
    ]
  ) ?>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th><input type="checkbox"></th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Description</th>
          <th>Créé le</th>
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
            <td><?= htmlspecialchars($teacher['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</section>