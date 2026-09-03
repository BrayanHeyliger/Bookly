<div class="apple-card p-4 mb-6 flex flex-wrap items-center gap-3">
<input class="input max-w-sm" placeholder="Search addons...">
<div class="ml-auto text-sm text-black/50"><?= count(array_filter($addons, fn ($a) => $a['is_installed'])) ?> installed of <?= count($addons) ?></div>
</div>
<?php foreach ($grouped as $cat => $items): ?>
<div class="mb-8">
<div class="text-lg font-semibold mb-3"><?= e($cat) ?></div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
<?php foreach ($items as $a): ?>
<div class="apple-card p-6 flex flex-col">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-2xl grid place-items-center text-white text-xl" style="background: linear-gradient(135deg, <?= e($a['color']) ?>, #5AC8FA)"><?= e($a['icon'] ? substr($a['icon'], 0, 1) : '🧩') ?></div>
<div><div class="font-semibold"><?= e($a['name']) ?></div><div class="text-xs text-black/50"><?= e($a['version']) ?> · <?= e($a['author']) ?></div></div>
</div>
<div class="text-sm text-black/60 mt-3 flex-1"><?= e($a['description']) ?></div>
<div class="flex items-center justify-between mt-4 pt-4 border-t border-black/5">
<div class="text-sm font-semibold"><?= $a['price'] > 0 ? '$'.number_format($a['price'], 0).'/mo' : 'Free' ?></div>
<div class="flex gap-2">
<?php if ($a['is_installed']): ?>
<form method="POST" action="/addons/<?= e($a['slug']) ?>/toggle"><?= csrf_field() ?><button class="text-xs pill bg-[#E8F8EE] text-[#34C759]"><?= $a['is_active'] ? '✓ Active' : 'Inactive' ?></button></form>
<form method="POST" action="/addons/<?= e($a['slug']) ?>/uninstall"><?= csrf_field() ?><button class="text-xs pill bg-[#FFF5F5] text-[#FF3B30]">Uninstall</button></form>
<?php else: ?>
<form method="POST" action="/addons/<?= e($a['slug']) ?>/install"><?= csrf_field() ?><button class="btn-primary text-xs py-2 px-3">Install</button></form>
<?php endif; ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<?php endforeach; ?>
