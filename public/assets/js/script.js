/**
 * Gestion des accordéons de la sidebar
 */

// Fonction pour basculer l'affichage du sous-menu
function toggleAccordion(id) {
  const submenu = document.getElementById(id);
  if (!submenu) return;
  
  submenu.classList.toggle('hidden');
  
  const button = submenu.previousElementSibling;
  if (button) {
    button.classList.toggle('active');
  }
}

