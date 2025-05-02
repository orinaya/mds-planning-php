<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['title'] ?? 'Ma page' ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
  <script src="<?= BASE_URL ?>/assets/js/script.js" defer></script>
</head>

<body>

  <div class="layout-container">

    <aside class="sidebar">
      <?= $sidebarContent ?>
    </aside>

    <div class="main-content">
      <?php
      if (isset($content) && is_callable($content)) {
        $content();
      } else {
        echo "Aucun contenu disponible";
      }
      ?>
    </div>

  </div>
</body>

</html>