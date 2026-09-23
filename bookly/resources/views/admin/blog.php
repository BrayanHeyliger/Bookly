<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

  <div class="apple-card p-6">
    <div class="text-lg font-semibold mb-1">New article</div>
    <p class="text-sm text-black/50 mb-5">Published posts show up on the public blog at <a href="/blog" class="text-[#0071E3]">/blog</a>.</p>
    <form method="POST" action="/admin/blog" class="space-y-4">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="create">
      <div><label class="label">Title</label><input class="input" name="title" required placeholder="5 ways to reduce no-shows"></div>
      <div><label class="label">Excerpt</label><input class="input" name="excerpt" placeholder="One-line summary for listings"></div>
      <div><label class="label">Content</label><textarea class="input" name="content" rows="8" placeholder="Write in Markdown or plain text..."></textarea></div>
      <label class="flex items-center gap-2 text-sm text-black/60">
        <input type="checkbox" name="is_published" class="rounded accent-[#0071E3]"> Publish immediately
      </label>
      <button type="submit" class="btn-primary">Create article</button>
    </form>
  </div>

  <div class="space-y-4">
    <?php if (empty($posts)): ?>
      <div class="apple-card p-10 text-center text-black/40">No articles yet.</div>
    <?php else: foreach ($posts as $p): ?>
      <div class="apple-card p-5">
        <div class="flex items-start justify-between gap-3">
          <div>
            <div class="font-semibold"><?= e($p['title']) ?></div>
            <div class="text-xs text-black/50 mt-1"><?= date('M j, Y', strtotime($p['created_at'] ?? 'now')) ?></div>
          </div>
          <span class="pill text-[10px] <?= $p['is_published'] ? 'bg-[#E8F8EE] text-[#34C759]' : 'bg-black/5 text-black/40' ?>">
            <?= $p['is_published'] ? 'Published' : 'Draft' ?>
          </span>
        </div>
        <?php if (! empty($p['excerpt'])): ?>
          <p class="text-sm text-black/60 mt-3"><?= e($p['excerpt']) ?></p>
        <?php endif; ?>
        <div class="mt-4 pt-4 border-t border-black/5">
          <?php if ($p['is_published']): ?>
            <a href="/blog/<?= e($p['slug']) ?>" class="text-xs text-[#0071E3] hover:underline mr-3">View</a>
          <?php endif; ?>
          <button type="button" class="text-xs text-[#0071E3] hover:underline mr-3" onclick="document.getElementById('post-<?= (int)$p['id'] ?>').classList.toggle('hidden')">Edit</button>
          <form method="POST" action="/admin/blog" class="inline" onsubmit="return confirm('Delete this article?')">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
            <button class="text-xs text-[#FF3B30] hover:underline">Delete</button>
          </form>
        </div>
        <form id="post-<?= (int)$p['id'] ?>" method="POST" action="/admin/blog" class="hidden mt-4 pt-4 border-t border-black/5 space-y-3">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
          <div><label class="label">Title</label><input class="input" name="title" value="<?= e($p['title']) ?>" required></div>
          <div><label class="label">Excerpt</label><input class="input" name="excerpt" value="<?= e($p['excerpt'] ?? '') ?>"></div>
          <div><label class="label">Content</label><textarea class="input" name="content" rows="8"><?= e($p['content'] ?? '') ?></textarea></div>
          <label class="flex items-center gap-2 text-sm text-black/60">
            <input type="checkbox" name="is_published" <?= $p['is_published'] ? 'checked' : '' ?> class="rounded accent-[#0071E3]"> Published
          </label>
          <div class="flex gap-3">
            <button type="submit" class="btn-primary text-sm">Save</button>
            <button type="button" class="btn-ghost text-sm" onclick="document.getElementById('post-<?= (int)$p['id'] ?>').classList.add('hidden')">Cancel</button>
          </div>
        </form>
      </div>
    <?php endforeach; endif; ?>
  </div>
</div>
