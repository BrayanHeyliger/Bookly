<div class="max-w-3xl mx-auto px-4 py-8">
  <a href="/blog" class="text-sm text-[#0071E3] hover:underline mb-4 inline-block">← All articles</a>
  <div class="apple-card p-8">
    <div class="text-xs text-black/40 mb-2"><?= date('M j, Y', strtotime($post['created_at'])) ?></div>
    <h1 class="text-3xl font-semibold mb-4"><?= e($post['title']) ?></h1>
    <?php if (!empty($post['excerpt'])): ?><p class="text-black/60 mb-6"><?= e($post['excerpt']) ?></p><?php endif; ?>
    <div class="prose prose-lg text-black/80 whitespace-pre-wrap"><?= e($post['content']) ?></div>
  </div>
</div>
