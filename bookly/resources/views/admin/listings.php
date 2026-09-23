<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

  <div class="apple-card p-6">
    <div class="text-lg font-semibold mb-1">Add a listing</div>
    <p class="text-sm text-black/50 mb-5">Businesses appear in the public directory at <a href="/explore" class="text-[#0071E3]">/explore</a>.</p>
    <form method="POST" action="/admin/listings" class="space-y-4">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="create">
      <div><label class="label">Business name</label><input class="input" name="name" required placeholder="Fade Factory"></div>
      <div class="grid grid-cols-2 gap-4">
        <div><label class="label">Category</label><input class="input" name="category" placeholder="Barbershop"></div>
        <div><label class="label">City</label><input class="input" name="city" placeholder="Miami"></div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div><label class="label">Email</label><input class="input" name="email" type="email"></div>
        <div><label class="label">Phone</label><input class="input" name="phone" type="tel"></div>
      </div>
      <div><label class="label">Address</label><input class="input" name="address"></div>
      <div><label class="label">Description</label><textarea class="input" name="description" rows="3"></textarea></div>
      <label class="flex items-center gap-2 text-sm text-black/60">
        <input type="checkbox" name="is_active" checked class="rounded accent-[#0071E3]"> Visible in the directory
      </label>
      <button type="submit" class="btn-primary">Create listing</button>
    </form>
  </div>

  <div class="space-y-4">
    <?php if (empty($listings)): ?>
      <div class="apple-card p-10 text-center text-black/40">No listings yet.</div>
    <?php else: foreach ($listings as $l): ?>
      <div class="apple-card p-5">
        <div class="flex items-start justify-between">
          <div>
            <div class="font-semibold"><?= e($l['name']) ?></div>
            <div class="text-xs text-black/50 mt-0.5">
              <?= e($l['category'] ?: 'No category') ?> &middot; <?= e($l['city'] ?: 'No city') ?>
            </div>
          </div>
          <span class="pill text-[10px] <?= $l['is_active'] ? 'bg-[#E8F8EE] text-[#34C759]' : 'bg-black/5 text-black/40' ?>">
            <?= $l['is_active'] ? 'Active' : 'Hidden' ?>
          </span>
        </div>
        <?php if (! empty($l['slug'])): ?>
          <div class="text-xs text-black/40 mt-2">/book/<?= e($l['slug']) ?></div>
        <?php endif; ?>
        <div class="mt-4 pt-4 border-t border-black/5">
          <button type="button" class="text-xs text-[#0071E3] hover:underline mr-3" onclick="document.getElementById('listing-<?= (int)$l['id'] ?>').classList.toggle('hidden')">Edit</button>
          <form method="POST" action="/admin/listings" class="inline" onsubmit="return confirm('Remove this listing?')">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
            <button class="text-xs text-[#FF3B30] hover:underline">Delete</button>
          </form>
        </div>
        <form id="listing-<?= (int)$l['id'] ?>" method="POST" action="/admin/listings" class="hidden mt-4 pt-4 border-t border-black/5 space-y-3">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
          <div><label class="label">Name</label><input class="input" name="name" value="<?= e($l['name']) ?>" required></div>
          <div class="grid grid-cols-2 gap-3">
            <div><label class="label">Category</label><input class="input" name="category" value="<?= e($l['category'] ?? '') ?>"></div>
            <div><label class="label">City</label><input class="input" name="city" value="<?= e($l['city'] ?? '') ?>"></div>
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div><label class="label">Email</label><input class="input" name="email" type="email" value="<?= e($l['email'] ?? '') ?>"></div>
            <div><label class="label">Phone</label><input class="input" name="phone" type="tel" value="<?= e($l['phone'] ?? '') ?>"></div>
          </div>
          <div><label class="label">Address</label><input class="input" name="address" value="<?= e($l['address'] ?? '') ?>"></div>
          <div><label class="label">Description</label><textarea class="input" name="description" rows="3"><?= e($l['description'] ?? '') ?></textarea></div>
          <label class="flex items-center gap-2 text-sm text-black/60">
            <input type="checkbox" name="is_active" <?= $l['is_active'] ? 'checked' : '' ?> class="rounded accent-[#0071E3]"> Visible in the directory
          </label>
          <div class="flex gap-3">
            <button type="submit" class="btn-primary text-sm">Save</button>
            <button type="button" class="btn-ghost text-sm" onclick="document.getElementById('listing-<?= (int)$l['id'] ?>').classList.add('hidden')">Cancel</button>
          </div>
        </form>
      </div>
    <?php endforeach; endif; ?>
  </div>
</div>
