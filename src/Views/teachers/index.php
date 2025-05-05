<?php include_once(__DIR__ . '/../partials/HeaderComponent.php'); ?>
<?php include_once(__DIR__ . '/../partials/TableComponent.php'); ?>

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

  <?php
  $columns = [
    'lastname' => 'Nom',
    'firstname' => 'Prénom',
    'email' => 'Email',
    'description' => 'Description',
    'created_at' => 'Créé le'
  ];

  $rows = array_map(function ($teacher) {
    return [
      'lastname' => $teacher['lastname'],
      'firstname' => $teacher['firstname'],
      'email' => $teacher['email'],
      'description' => $teacher['description'],
      'created_at' => $teacher['created_at']
    ];
  }, $teachers);

  TableComponent($columns, $rows, 'teacherTableBody'); ?>

</section>