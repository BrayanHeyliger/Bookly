<div class="space-y-4">
  <div class="apple-card p-6">
    <div class="text-lg font-semibold mb-4">Add team member</div>
    <form method="POST" action="/staff" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="create">
      <div><label class="label">Full name</label><input class="input" name="name" required placeholder="Jane Doe"></div>
      <div><label class="label">Email</label><input class="input" name="email" type="email" required placeholder="jane@example.com"></div>
      <div><label class="label">Role</label><select class="input" name="role"><option value="staff">Staff</option><option value="manager">Manager</option></select></div>
      <div><label class="label">Password</label><input class="input" name="password" type="text" placeholder="Initial password"></div>
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
        <tr><td colspan="5" class="p-6 text-center text-black/40">No staff yet. Add your first team member above.</td></tr>
      <?php else: foreach ($staff as $s): ?>
        <tr class="hover:bg-black/[0.02] transition">
          <td class="p-3 font-medium"><?= e($s['name'] ?? '—') ?></td>
          <td class="p-3 text-black/60"><?= e($s['email'] ?? '—') ?></td>
          <td class="p-3"><span class="pill bg-[#E8F3FF] text-[#0071E3]"><?= ucfirst($s['role'] ?? 'staff') ?></span></td>
          <td class="p-3"><?= $s['is_active'] ? '<span class="text-[#34C759]">● Active</span>' : '<span class="text-black/30">● Inactive</span>' ?></td>
          <td class="p-3 text-right">
            <form method="POST" action="/staff" class="inline" onsubmit="return confirm('Remove this member?')">
              <?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
              <button class="text-xs text-[#FF3B30] hover:underline">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
