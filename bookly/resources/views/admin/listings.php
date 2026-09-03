<div class="space-y-4">
  <div class="apple-card p-6">
    <div class="text-lg font-semibold mb-4">Add business listing</div>
    <form method="POST" action="/admin/listings" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="create">
      <div><label class="label">Business name</label><input class="input" name="name" required placeholder="Studio Name"></div>
      <div><label class="label">Category</label><input class="input" name="category" placeholder="Barber, Salon, Spa..." required></div>
      <div><label class="label">City</label><input class="input" name="city" placeholder="New York" required></div>
      <div><label class="label">Email</label><input class="input" name="email" type="email" placeholder="owner@example.com"></div>
      <div><label class="label">Phone</label><input class="input" name="phone" placeholder="+1 555 1234"></div>
      <div><label class="label">Address</label><input class="input" name="address" placeholder="123 Main St"></div>
      <div class="lg:col-span-3"><label class="label">Description</label><textarea class="input" name="description" rows="2" placeholder="Short description..."></textarea></div>
      <div class="flex items-center gap-4">
        <label class="flex items-center gap-2"><input type="checkbox" name="is_active" checked class="accent-[#0071E3]"> <span class="text-sm">Active</span></label>
        <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" class="accent-[#0071E3]"> <span class="text-sm">Featured</span></label>
      </div>
      <div class="lg:col-span-3"><button type="submit" class="btn-primary">Create listing</button></div>
    </form>
  </div>

  <div class="apple-card overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-[#F5F5F7] text-left text-xs uppercase text-black/50">
        <tr><th class="p-3">Business</th><th class="p-3">Category</th><th class="p-3">City</th><th class="p-3">Status</th><th class="p-3 text-right">Actions</th></tr>
      </thead>
      <tbody class="divide-y divide-black/5">
      <?php if (empty($listings)): ?>
        <tr><td colspan="5" class="p-6 text-center text-black/40">No listings yet.</td></tr>
      <?php else: foreach ($listings as $l): ?>
        <tr class="hover:bg-black/[0.02] transition">
          <td class="p-3 font-medium">
            <a href="/business/<?= e($l['slug']) ?>" class="text-[#0071E3] hover:underline" target="_blank"><?= e($l['name']) ?></a>
          </td>
          <td class="p-3"><?= e($l['category'] ?? '—') ?></td>
          <td class="p-3"><?= e($l['city'] ?? '—') ?></td>
          <td class="p-3">
            <form method="POST" action="/admin/listings" class="inline" onsubmit="return confirm('Toggle active?')">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
              <input type="hidden" name="is_active" value="<?= $l['is_active'] ? '0' : '1' ?>">
              <button class="pill text-[10px] <?= $l['is_active'] ? 'bg-[#E8F8EE] text-[#34C759]' : 'bg-black/5 text-black/40' ?>"><?= $l['is_active'] ? 'Active' : 'Inactive' ?></button>
            </form>
            <form method="POST" action="/admin/listings" class="inline" onsubmit="return confirm('Toggle featured?')">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
              <input type="hidden" name="is_featured" value="<?= $l['is_featured'] ? '0' : '1' ?>">
              <button class="pill text-[10px] <?= $l['is_featured'] ? 'bg-[#E8F3FF] text-[#0071E3]' : 'bg-black/5 text-black/30' ?>"><?= $l['is_featured'] ? 'Featured' : 'Standard' ?></button>
            </form>
          </td>
          <td class="p-3 text-right">
            <form method="POST" action="/admin/listings" class="inline" onsubmit="return confirm('Remove this listing?')">
              <?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
              <button class="text-xs text-[#FF3B30] hover:underline">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
