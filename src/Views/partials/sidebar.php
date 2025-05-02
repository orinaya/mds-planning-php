  <div class="profile">
    <div class="profile-pic">
      JD
    </div>
    <h2 class="username">
      jean.biche@example.com
      <span class="icon-verified-check"></span>
    </h2>
    <span class="role">
      Admin
    </span>
  </div>

  <nav class="menu">
    <ul>
      <li class="submenu home-link">
        <a href="<?= BASE_URL ?>/">Accueil</a>
      </li>
      <li>
        <button class="accordion-btn active" onclick="toggleAccordion('planning-menu')">
          <div>
            <span class="icon-notebook"></span> Planning
          </div>
          <span class="icon-alt-arrow-down"></span>
        </button>
        <ul id="planning-menu" class="submenu active">
          <li><a href="<?= BASE_URL ?>/planning">Planning Étudiants</a></li>
          <li><a href="<?= BASE_URL ?>/planning-formateurs">Planning Formateurs</a></li>
        </ul>
      </li>
      <li>
        <button class="accordion-btn" onclick="toggleAccordion('year-menu')">
          <div>
            <span class="icon-cart"></span> Année scolaire
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
          <div>
            <span class="icon-cart"></span> Formateurs
          </div>
          <span class="icon-alt-arrow-down"></span>
        </button>
        <ul id="formateurs-menu" class="submenu active">
          <li><a href="<?= BASE_URL ?>/formateurs">Liste des formateurs</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <div class="sidebar-footer">
    <a href="/settings" class="settings-btn">
      <span class="icon-settings"></span> Paramètres
    </a>
    <a href="/logout" class="logout-btn">
      <span class="icon-logout"></span> Se déconnecter
    </a>
  </div>