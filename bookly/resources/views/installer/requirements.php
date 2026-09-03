<h2 class="text-2xl font-semibold tracking-tight">System Requirements</h2>
<p class="text-black/50 mt-1">Verifying that your server meets the requirements to run Bookly.</p>
<div class="mt-8 space-y-2">
<?php foreach ($checks as $c): ?>
<div class="flex items-center justify-between p-4 rounded-2xl <?= $c['ok'] ? 'bg-[#F2FBF4] border border-[#34C759]/20' : 'bg-[#FFF5F5] border border-[#FF3B30]/20' ?>">
<div class="flex items-center gap-3">
<div class="w-6 h-6 rounded-full grid place-items-center <?= $c['ok'] ? 'bg-[#34C759] text-white' : 'bg-[#FF3B30] text-white' ?> text-xs"><?= $c['ok'] ? '✓' : '!' ?></div>
<div><div class="font-medium text-sm"><?= e($c['name']) ?></div><div class="text-xs text-black/50"><?= e($c['detail']) ?></div></div>
</div>
<div class="text-xs text-black/50"><?= $c['ok'] ? 'OK' : 'Fail' ?></div>
</div>
<?php endforeach; ?>
</div>
<div class="mt-8 flex items-center justify-between">
<a href="/install" class="btn-ghost">← Back</a>
<?php if ($allOk): ?>
<a href="/install/database" class="btn-primary">Continue →</a>
<?php else: ?>
<button disabled class="opacity-50 cursor-not-allowed btn-primary">Fix issues to continue</button>
<?php endif; ?>
</div>
