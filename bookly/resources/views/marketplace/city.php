<div class="max-w-6xl mx-auto px-4 py-8">
  <div class="mb-6">
    <h1 class="text-3xl font-semibold"><?= e($city) ?></h1>
    <p class="text-black/50 mt-1"><?= count($businesses) ?> businesses found</p>
  </div>
  <?php if (empty($businesses)): ?>
    <div class="apple-card p-12 text-center text-black/40">No businesses in this city yet.</div>
  <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <?php foreach ($businesses as $b): ?>
      <a href="/business/<?= e($b['slug']) ?>" class="biz-card">
        <div class="biz-card-img"><?= $b['category'] === 'Barber' ? '💇' : ($b['category'] === 'Hair Salon' ? '💆' : '✨') ?></div>
        <div class="biz-card-body">
          <div class="font-semibold"><?= e($b['name']) ?></div>
          <div class="text-xs text-black/50 mt-1"><?= e($b['category'] ?? '') ?></div>
          <div class="flex items-center gap-1 mt-2 text-xs">⭐ <?= number_format($b['avg_rating'], 1) ?> <span class="text-black/50">(<?= (int)$b['review_count'] ?>)</span></div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
