<?php
$required = $required ?? null;
?>
<div class="max-w-lg mx-auto mt-24 text-center">
  <h1 class="text-2xl font-semibold mb-2">Not available on your plan</h1>
  <p class="text-black/50 mb-8">
    <?php if ($required): ?>
      This area needs the <strong><?= e($required) ?></strong> role or higher.
    <?php else: ?>
      Your account does not have access to this area.
    <?php endif; ?>
  </p>
  <a href="/dashboard" class="btn-primary">Back to dashboard</a>
</div>
