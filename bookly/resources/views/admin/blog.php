<div class="space-y-4">
  <div class="apple-card p-6">
    <div class="text-lg font-semibold mb-4">Write article</div>
    <form method="POST" action="/admin/blog" class="space-y-3">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="create">
      <div><label class="label">Title</label><input class="input" name="title" required placeholder="How to choose the right barber..."></div>
      <div><label class="label">Excerpt</label><input class="input" name="excerpt" placeholder="Short summary for SEO..."></div>
      <div><label class="label">Content</label><textarea class="input" name="content" rows="6" placeholder="Write your article..."></textarea></div>
      <div class="flex items-center gap-4">
        <label class="flex items-center gap-2"><input type="checkbox" name="is_published" checked class="accent-[#0071E3]"> <span class="text-sm">Published</span></label>
        <button type="submit" class="btn-primary">Publish article</button>
      </div>
    </form>
  </div>

  <div class="apple-card overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-[#F5F5F7] text-left text-xs uppercase text-black/50">
        <tr><th class="p-3">Title</th><th class="p-3">Status</th><th class="p-3">Date</th><th class="p-3 text-right">Actions</th></tr>
      </thead>
      <tbody class="divide-y divide-black/5">
      <?php if (empty($posts)): ?>
        <tr><td colspan="4" class="p-6 text-center text-black/40">No articles yet.</td></tr>
      <?php else: foreach ($posts as $p): ?>
        <tr class="hover:bg-black/[0.02] transition">
          <td class="p-3 font-medium"><?= e($p['title']) ?></td>
          <td class="p-3"><span class="pill text-[10px] <?= $p['is_published'] ? 'bg-[#E8F8EE] text-[#34C759]' : 'bg-black/5 text-black/40' ?>"><?= $p['is_published'] ? 'Published' : 'Draft' ?></span></td>
          <td class="p-3 text-black/50"><?= date('M j, Y', strtotime($p['created_at'])) ?></td>
          <td class="p-3 text-right">
            <form method="POST" action="/admin/blog" class="inline" onsubmit="return confirm('Delete this article?')">
              <?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
              <button class="text-xs text-[#FF3B30] hover:underline">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
