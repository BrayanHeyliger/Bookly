<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
<?php foreach ($services as $s): ?>
<div class="apple-card p-6">
<div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full" style="background: <?= e($s['color'] ?? '#0071E3') ?>"></div><div class="text-xs text-black/50"><?= e($s['category'] ?? 'General') ?></div></div>
<div class="text-lg font-semibold mt-1"><?= e($s['name']) ?></div>
<div class="text-sm text-black/50 mt-1"><?= $s['duration'] ?> min · $<?= number_format($s['price'], 2) ?></div>
<?php if (! empty($s['description'])): ?><div class="text-sm mt-3"><?= e($s['description']) ?></div><?php endif; ?>
</div>
<?php endforeach; ?>
</div>
