<div class="apple-card p-6 max-w-2xl">
  <div class="text-lg font-semibold mb-4">Edit service</div>
  <form method="POST" action="/services/<?= (int)($service['id'] ?? 0) ?>" class="space-y-4">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">
    <div><label class="label">Service name</label><input class="input" name="name" value="<?= e($service['name'] ?? '') ?>" required></div>
    <div class="grid grid-cols-2 gap-3">
      <div><label class="label">Duration (min)</label><input class="input" name="duration" type="number" value="<?= (int)($service['duration'] ?? 30) ?>" min="5"></div>
      <div><label class="label">Price ($)</label><input class="input" name="price" type="number" step="0.01" value="<?= number_format($service['price'] ?? 0, 2) ?>" min="0"></div>
    </div>
    <div><label class="label">Description</label><textarea class="input" name="description" rows="3"><?= e($service['description'] ?? '') ?></textarea></div>
    <div class="flex items-center gap-2">
      <input type="checkbox" name="is_active" id="svcActive" <?= ($service['is_active'] ?? 1) ? 'checked' : '' ?> class="w-4 h-4 accent-[#0071E3]">
      <label for="svcActive" class="text-sm">Active (visible on booking page)</label>
    </div>
    <div class="flex gap-3">
      <button type="submit" class="btn-primary">Save changes</button>
      <a href="/services" class="btn-ghost">Cancel</a>
    </div>
  </form>
</div>
