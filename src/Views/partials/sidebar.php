<?php
include_once('LinkParticle.php');
include_once('ButtonParticle.php');
?>
<button id="toggle-sidebar" class="toggle-sidebar-btn"><span class="icon-square-double-arrow-left"></span></button>

<div class="sidebar-container_content">
  <div class="profile">
    <div class="profile-pic">JD</div>
    <h2 class="username">
      <span class="label">jean.biche@gmail.com</span>
      <span class="icon-verified-check"></span>
    </h2>
    <span class="role"><span class="label">Admin</span></span>
  </div>

  <nav class="menu">
    <ul>
      <li class="home-link">
        <a href="<?= BASE_URL ?>/" class="label">
          <span class="icon-home-1"></span>
          Accueil
        </a>
      </li>

      <li>
        <button class="accordion-btn active" onclick="toggleAccordion('planning-menu')">
          <div class="label">
            <span class="icon-calendar"></span>
            Planification
          </div>
          <span class="icon-alt-arrow-down"></span>
        </button>
        <ul id="planning-menu" class="submenu">
          <li><a href="<?= BASE_URL ?>/planning">Planning Étudiants</a></li>
          <li><a href="<?= BASE_URL ?>/planning-formateurs">Planning Formateurs</a></li>
        </ul>
      </li>

      <li>
        <button class="accordion-btn" onclick="toggleAccordion('year-menu')">
          <div class="label">
            <span class="icon-academic-square"></span>
            Année scolaire
          </div>
          <span class="icon-alt-arrow-down"></span>
        </button>
        <ul id="year-menu" class="submenu active">
          <li><a href="<?= BASE_URL ?>/classes">Liste des classes</a></li>
          <li><a href="<?= BASE_URL ?>/annees">Liste des années</a></li>
        </ul>
      </li>

      <li>
        <button class="accordion-btn" onclick="toggleAccordion('formateurs-menu')">
          <div class="label">
            <span class="icon-case"></span>
            Formateurs
          </div>
          <span class="icon-alt-arrow-down"></span>
        </button>
        <ul id="formateurs-menu" class="submenu active">
          <li><a href="<?= BASE_URL ?>/formateurs">Liste des formateurs</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</div>

<div class="sidebar-container_footer">
  <?php LinkParticle('Voir les paramètres', 'primary', 'settings', '/settings', 'settings-link'); ?>
  <?php LinkParticle('Se déconnecter', 'danger', 'logout', '/logout', 'logout-link'); ?>
</div>