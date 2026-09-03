<div class="max-w-6xl mx-auto px-4 py-8">
  <div class="mb-6">
    <h1 class="text-3xl font-semibold">Search results</h1>
    <p class="text-black/50 mt-1"><?= count($businesses) ?> results for "<?= e($query) ?>"</p>
  </div>
  <?php if (empty($businesses)): ?>
    <div class="apple-card p-12 text-center">
      <div class="text-4xl mb-3">🔍</div>
      <div class="text-black/40">No businesses found. Try another search term.</div>
      <div class="flex items-center justify-center gap-2 mt-4">
        <a href="/explore" class="btn-primary">Explore all</a>
        <a href="/category/barber" class="btn-ghost border border-black/10">Barbers</a>
        <a href="/category/hair-salon" class="btn-ghost border border-black/10">Hair salons</a>
      </div>
    </div>
  <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      <?php foreach ($businesses as $b): ?>
      <a href="/business/<?= e($b['slug']) ?>" class="biz-card">
        <div class="biz-card-img"><?= $b['category'] === 'Barber' ? '💇' : ($b['category'] === 'Hair Salon' ? '💆' : '✨') ?></div>
        <div class="biz-card-body">
          <div class="font-semibold"><?= e($b['name']) ?></div>
          <div class="text-xs text-black/50 mt-1"><?= e($b['city'] ?? '') ?> · <?= e($b['category'] ?? '') ?></div>
          <div class="flex items-center gap-1 mt-2 text-xs">⭐ <?= number_format($b['avg_rating'], 1) ?> <span class="text-black/50">(<?= (int)$b['review_count'] ?>)</span></div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
