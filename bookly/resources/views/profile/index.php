<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
  <div class="apple-card p-6 lg:col-span-2">
    <div class="text-lg font-semibold mb-4">Edit profile</div>
    <form method="POST" action="/profile" class="space-y-4">
      <?= csrf_field() ?>
      <div><label class="label">Full name</label><input class="input" name="name" value="<?= e($user['name'] ?? '') ?>" required></div>
      <div><label class="label">Email</label><input class="input" name="email" type="email" value="<?= e($user['email'] ?? '') ?>" required></div>
      <div><label class="label">New password <span class="text-black/40 font-normal">(leave blank to keep current)</span></label><input class="input" name="password" type="password" placeholder="••••••"></div>
      <div class="flex gap-3">
        <button type="submit" class="btn-primary">Save changes</button>
        <a href="/dashboard" class="btn-ghost">Cancel</a>
      </div>
    </form>
  </div>
  <div class="apple-card p-6">
    <div class="text-sm font-medium text-black/50 mb-3">Account info</div>
    <div class="space-y-3 text-sm">
      <div><div class="text-black/40 text-xs">Role</div><div class="font-medium mt-0.5"><?= e($user['role'] ?? 'Owner') ?></div></div>
      <div><div class="text-black/40 text-xs">Member since</div><div class="font-medium mt-0.5"><?= e($user['created_at'] ?? '—') ?></div></div>
      <div><div class="text-black/40 text-xs">User ID</div><div class="font-medium mt-0.5">#<?= (int)($user['id'] ?? 0) ?></div></div>
    </div>
  </div>
</div>
