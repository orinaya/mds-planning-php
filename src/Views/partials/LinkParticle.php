<?php

function LinkParticle($children, $variant = 'primary', $icon = null, $link = '#', $id = null)
{
  $validVariants = ['primary', 'secondary', 'tertiary', 'neutral', 'success', 'warning', 'danger'];
  if (!in_array($variant, $validVariants)) {
    $variant = 'primary';
  }
?>
  <a href="<?php echo htmlspecialchars($link); ?>" class="button <?php echo htmlspecialchars($variant); ?>" id="<?php echo htmlspecialchars($id); ?>">
    <?php if ($icon): ?>
      <span class="icon icon-<?php echo htmlspecialchars($icon); ?>"></span>
    <?php endif; ?>
    <?php echo htmlspecialchars($children); ?>
  </a>
<?php
}
?>