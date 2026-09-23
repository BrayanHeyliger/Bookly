<div class="space-y-6">

  <div class="apple-card p-6">
    <div class="text-lg font-semibold mb-1">Add team member</div>
    <p class="text-sm text-black/50 mb-5">Staff accounts can only see their own calendar and bookings.</p>
    <form method="POST" action="/staff" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="create">
      <div><label class="label">Full name</label><input class="input" name="name" required placeholder="Jane Doe"></div>
      <div><label class="label">Email</label><input class="input" name="email" type="email" required placeholder="jane@example.com"></div>
      <div>
        <label class="label">Role</label>
        <select class="input" name="role">
          <option value="staff">Staff</option>
          <option value="manager">Manager</option>
          <option value="owner">Owner</option>
        </select>
      </div>
      <div>
        <label class="label">Initial password</label>
        <input class="input" name="password" type="password" required minlength="12" autocomplete="new-password" placeholder="At least 12 characters">
      </div>
      <label class="flex items-center gap-2 text-sm text-black/60 lg:col-span-2">
        <input type="checkbox" name="is_active" checked class="rounded accent-[#0071E3]"> Account active
      </label>
      <div class="lg:col-span-4"><button type="submit" class="btn-primary">Add member</button></div>
    </form>
  </div>

  <div class="apple-card overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-[#F5F5F7] text-left text-xs uppercase text-black/50">
        <tr><th class="p-3">Name</th><th class="p-3">Email</th><th class="p-3">Role</th><th class="p-3">Status</th><th class="p-3 text-right">Actions</th></tr>
      </thead>
      <tbody class="divide-y divide-black/5">
      <?php if (empty($staff)): ?>
        <tr><td colspan="5" class="p-10 text-center text-black/40">No staff yet. Add your first team member above.</td></tr>
      <?php else: foreach ($staff as $s): ?>
        <tr class="hover:bg-black/[0.02] transition">
          <td class="p-3 font-medium"><?= e($s['name'] ?? '-') ?></td>
          <td class="p-3 text-black/60"><?= e($s['email'] ?? '-') ?></td>
          <td class="p-3"><span class="pill bg-[#E8F3FF] text-[#0071E3]"><?= e(ucfirst($s['role_in_business'] ?? 'staff')) ?></span></td>
          <td class="p-3"><?= $s['is_active'] ? '<span class="text-[#34C759]">Active</span>' : '<span class="text-black/30">Inactive</span>' ?></td>
          <td class="p-3 text-right">
            <a href="/staff/availability" class="text-xs text-black/50 hover:underline mr-3">Hours</a>
            <button type="button" class="text-xs text-[#0071E3] hover:underline mr-3" onclick="document.getElementById('edit-<?= (int)$s['id'] ?>').classList.toggle('hidden')">Edit</button>
            <form method="POST" action="/staff" class="inline" onsubmit="return confirm('Remove this member? Their account will be deleted.')">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
              <button class="text-xs text-[#FF3B30] hover:underline">Remove</button>
            </form>
          </td>
        </tr>
        <tr id="edit-<?= (int)$s['id'] ?>" class="hidden bg-[#F5F5F7]">
          <td colspan="5" class="p-5">
            <form method="POST" action="/staff" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
              <div><label class="label">Full name</label><input class="input" name="name" value="<?= e($s['name'] ?? '') ?>" required></div>
              <div><label class="label">Email</label><input class="input" name="email" type="email" value="<?= e($s['email'] ?? '') ?>" required></div>
              <div>
                <label class="label">Role</label>
                <select class="input" name="role">
                  <?php foreach (['staff','manager','owner'] as $r): ?>
                    <option value="<?= $r ?>" <?= ($s['role_in_business'] ?? 'staff') === $r ? 'selected' : '' ?>><?= ucfirst($r) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="flex items-end gap-3">
                <label class="flex items-center gap-2 text-sm text-black/60 pb-3">
                  <input type="checkbox" name="is_active" <?= $s['is_active'] ? 'checked' : '' ?> class="rounded accent-[#0071E3]"> Active
                </label>
              </div>
              <div class="lg:col-span-4 flex gap-3">
                <button type="submit" class="btn-primary text-sm">Save changes</button>
                <button type="button" class="btn-ghost text-sm" onclick="document.getElementById('edit-<?= (int)$s['id'] ?>').classList.add('hidden')">Cancel</button>
              </div>
            </form>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
