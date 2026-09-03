<div class="apple-card p-6 max-w-2xl">
  <div class="text-lg font-semibold mb-4">Edit client</div>
  <form method="POST" action="/clients?edit=<?= (int)($client['id'] ?? 0) ?>" class="space-y-4">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div><label class="label">First name</label><input class="input" name="first_name" value="<?= e($client['first_name'] ?? '') ?>" required></div>
      <div><label class="label">Last name</label><input class="input" name="last_name" value="<?= e($client['last_name'] ?? '') ?>" required></div>
    </div>
    <div><label class="label">Email</label><input class="input" name="email" type="email" value="<?= e($client['email'] ?? '') ?>"></div>
    <div><label class="label">Phone</label><input class="input" name="phone" type="tel" value="<?= e($client['phone'] ?? '') ?>"></div>
    <div><label class="label">Notes</label><textarea class="input" name="notes" rows="3"><?= e($client['notes'] ?? '') ?></textarea></div>
    <div class="flex items-center gap-2">
      <input type="checkbox" name="is_favorite" id="favClient" <?= ($client['is_favorite'] ?? 0) ? 'checked' : '' ?> class="w-4 h-4 accent-[#0071E3]">
      <label for="favClient" class="text-sm">Mark as favorite</label>
    </div>
    <div class="flex gap-3">
      <button type="submit" class="btn-primary">Save changes</button>
      <a href="/clients" class="btn-ghost">Cancel</a>
    </div>
  </form>
</div>
