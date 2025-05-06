<div id="genericModal" class="modal" style="display: none;">
  <div class="modal-content">
    <div class="modal-header">
      <h3><i id="genericModalIcon" class="icon"></i> <span id="genericModalTitle">Titre</span></h3>
      <button class="close-btn" id="genericModalClose">&times;</button>
    </div>
    <form id="genericModalForm">
      <div id="genericModalBody" class="modal-body">
        <!-- Contenu dynamique injecté ici -->
      </div>
      <div class="form-actions">
        <?php ButtonParticle('Annuler', 'danger', 'trash-bin', 'genericModalCancel'); ?>
        <?php ButtonParticle('Enregistrer', 'success', 'check', '', 'submit'); ?>
      </div>
    </form>
  </div>
</div>