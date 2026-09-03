<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
<?php if (empty($reviews)): ?>
<div class="apple-card p-12 text-center text-black/40 col-span-full">No reviews yet.</div>
<?php else: foreach ($reviews as $r): ?>
<div class="apple-card p-6">
<div class="flex items-center gap-1 text-[#FF9500]">
<?php for ($i = 0; $i < 5; $i++): ?><span><?= $i < $r['rating'] ? '★' : '☆' ?></span><?php endfor; ?>
</div>
<div class="mt-3 text-sm"><?= e($r['comment']) ?></div>
<div class="text-xs text-black/40 mt-3"><?= e($r['business_name']) ?> · <?= date('M j', strtotime($r['created_at'])) ?></div>
</div>
<?php endforeach; endif; ?>
</div>
