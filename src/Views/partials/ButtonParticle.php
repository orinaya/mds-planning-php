<?php
function ButtonParticle($children, $variant = 'primary', $icon = null, $id = null, $type = 'button')
{
  $validVariants = ['primary', 'secondary', 'tertiary', 'neutral', 'success', 'warning', 'danger'];
  if (!in_array($variant, $validVariants)) {
    $variant = 'primary';
  }

  $idAttribute = $id ? 'id="' . htmlspecialchars($id) . '"' : '';
?>
  <button class="button <?php echo htmlspecialchars($variant); ?>" <?php echo $idAttribute; ?> type="<?php echo $type; ?>">
    <?php if ($icon): ?>
      <span class="icon icon-<?php echo htmlspecialchars($icon); ?>"></span>
    <?php endif; ?>
    <?php echo htmlspecialchars($children); ?>
  </button>
<?php
}
?>