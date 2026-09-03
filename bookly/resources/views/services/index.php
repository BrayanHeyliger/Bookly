<div class="space-y-4">
  <div class="flex items-center justify-between">
    <div class="text-sm text-black/50"><?= count($services) ?> services configured</div>
    <a href="/services?new=1" class="btn-primary text-sm">+ New service</a>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
  <?php foreach ($services as $s): ?>
    <div class="apple-card p-5 hover:shadow-md transition">
      <div class="flex items-start justify-between">
        <div class="flex items-center gap-2">
          <div class="w-3 h-3 rounded-full" style="background: <?= e($s['color'] ?? '#0071E3') ?>"></div>
          <div class="text-xs text-black/50"><?= e($s['category'] ?? 'General') ?></div>
        </div>
        <div class="flex gap-1">
          <a href="/services/<?= (int)$s['id'] ?>/edit" class="text-xs text-[#0071E3] hover:underline px-2 py-1">Edit</a>
        </div>
      </div>
      <div class="text-lg font-semibold mt-2"><?= e($s['name']) ?></div>
      <div class="text-sm text-black/50 mt-1"><?= (int)$s['duration'] ?> min · $<?= number_format($s['price'], 2) ?></div>
      <?php if (! empty($s['description'])): ?><div class="text-sm text-black/60 mt-3 line-clamp-2"><?= e($s['description']) ?></div><?php endif; ?>
      <div class="mt-4 pt-3 border-t border-black/5 flex items-center justify-between">
        <span class="pill text-[10px] <?= $s['is_active'] ? 'bg-[#E8F8EE] text-[#34C759]' : 'bg-black/5 text-black/40' ?>"><?= $s['is_active'] ? 'Active' : 'Inactive' ?></span>
        <form method="POST" action="/services/<?= (int)$s['id'] ?>" onsubmit="return confirm('Delete this service?')" class="inline">
          <?= csrf_field() ?><input type="hidden" name="_method" value="DELETE">
          <button class="text-xs text-[#FF3B30] hover:underline">Delete</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
  </div>

  <?php if (! empty($_GET['new'])): ?>
  <div class="apple-card p-6 mt-6">
    <div class="text-lg font-semibold mb-4">New service</div>
    <form method="POST" action="/services" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <?= csrf_field() ?>
      <div><label class="label">Name</label><input class="input" name="name" required placeholder="Haircut"></div>
      <div><label class="label">Category</label><input class="input" name="category" placeholder="General" value="General"></div>
      <div><label class="label">Duration (min)</label><input class="input" name="duration" type="number" value="30" min="5"></div>
      <div><label class="label">Price ($)</label><input class="input" name="price" type="number" step="0.01" value="0" min="0"></div>
      <div class="sm:col-span-2"><label class="label">Description</label><textarea class="input" name="description" rows="2" placeholder="What's included..."></textarea></div>
      <div class="sm:col-span-2 flex gap-3">
        <button type="submit" class="btn-primary">Create service</button>
        <a href="/services" class="btn-ghost">Cancel</a>
      </div>
    </form>
  </div>
  <?php endif; ?>
</div>
