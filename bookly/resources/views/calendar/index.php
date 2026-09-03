<div class="apple-card p-6">
<div class="flex items-center justify-between mb-4">
<div class="flex items-center gap-2">
<a href="?date=<?= date('Y-m-d', strtotime($start.' -7 days')) ?>" class="btn-ghost text-sm">←</a>
<div class="font-semibold">Week of <?= date('M j, Y', strtotime($start)) ?></div>
<a href="?date=<?= date('Y-m-d', strtotime($start.' +7 days')) ?>" class="btn-ghost text-sm">→</a>
</div>
<div class="flex gap-2 text-xs">
<span class="pill bg-[#E8F3FF] text-[#0071E3]">Confirmed</span>
<span class="pill bg-[#E8F8EE] text-[#34C759]">Completed</span>
<span class="pill bg-[#FFF5F5] text-[#FF3B30]">Cancelled</span>
</div>
</div>
<div class="grid grid-cols-7 gap-2 text-center text-xs font-medium text-black/50">
<?php foreach (['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $d): ?><div><?= $d ?></div><?php endforeach; ?>
</div>
<div class="grid grid-cols-7 gap-2 mt-2">
<?php for ($i = 0; $i < 7; $i++): $day = date('Y-m-d', strtotime($start." +{$i} days")); ?>
<div class="min-h-[280px] p-2 rounded-2xl bg-[#F5F5F7]">
<div class="text-xs font-semibold mb-2"><?= date('j', strtotime($day)) ?></div>
<?php foreach ($bookings as $b): if (date('Y-m-d', strtotime($b['start_at'])) === $day): ?>
<div class="p-2 rounded-xl bg-white text-xs mb-1 border-l-2" style="border-color: <?= $b['status'] === 'completed' ? '#34C759' : ($b['status'] === 'cancelled' ? '#FF3B30' : '#0071E3') ?>">
<div class="font-semibold"><?= date('H:i', strtotime($b['start_at'])) ?></div>
<div class="truncate"><?= e($b['service_name'] ?? '—') ?></div>
<div class="text-black/50 truncate"><?= e($b['client_name'] ?? '—') ?></div>
</div>
<?php endif; endforeach; ?>
</div>
<?php endfor; ?>
</div>
</div>
