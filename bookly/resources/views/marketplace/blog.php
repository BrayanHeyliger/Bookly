<div class="max-w-5xl mx-auto px-4 py-8">
  <div class="text-center mb-10">
    <div class="pill bg-[#E8F3FF] text-[#0071E3] mb-3"><span>📝</span> Blog</div>
    <h1 class="text-3xl md:text-4xl font-semibold">Tips, trends & guides</h1>
  </div>
  <?php if (empty($posts)): ?>
    <div class="apple-card p-12 text-center text-black/40">No articles published yet.</div>
  <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <?php foreach ($posts as $p): ?>
        <a href="/blog/<?= e($p['slug']) ?>" class="apple-card p-6 block hover:shadow-lg transition">
          <div class="text-xs text-black/40 mb-2"><?= date('M j, Y', strtotime($p['created_at'])) ?></div>
          <div class="text-lg font-semibold"><?= e($p['title']) ?></div>
          <div class="text-sm text-black/60 mt-2 line-clamp-2"><?= e($p['excerpt'] ?? '') ?></div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
