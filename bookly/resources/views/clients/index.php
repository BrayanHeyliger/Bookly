<div class="apple-card overflow-hidden">
  <div class="p-4 border-b border-black/5 flex items-center justify-between">
    <div class="text-sm text-black/50"><?= count($clients) ?> clients</div>
    <input class="input max-w-xs text-sm py-2" placeholder="Search..." oninput="const q=this.value.toLowerCase();document.querySelectorAll('#clientsTable tbody tr').forEach(r=>{r.style.display=r.textContent.toLowerCase().includes(q)?'':'none'})">
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm" id="clientsTable">
    <thead class="text-left text-xs uppercase text-black/50 bg-[#F5F5F7]">
      <tr><th class="p-3">Client</th><th class="p-3">Email</th><th class="p-3">Phone</th><th class="p-3 text-center">Visits</th><th class="p-3 text-right">Spent</th><th class="p-3 text-center">Actions</th></tr>
    </thead>
    <tbody>
    <?php if (empty($clients)): ?>
      <tr><td colspan="6" class="p-10 text-center text-black/40">No clients yet. Bookings will create clients automatically.</td></tr>
    <?php else: foreach ($clients as $c): ?>
      <tr class="border-t border-black/5 hover:bg-black/[0.02] transition">
        <td class="p-3">
          <div class="font-medium"><?= e($c['first_name'].' '.$c['last_name']) ?></div>
          <?php if ($c['is_favorite']): ?><div class="text-[10px] text-[#FF9500] mt-0.5">⭐ Favorite</div><?php endif; ?>
        </td>
        <td class="p-3 text-black/60"><?= e($c['email']) ?></td>
        <td class="p-3 text-black/60"><?= e($c['phone'] ?: '—') ?></td>
        <td class="p-3 text-center"><span class="pill bg-black/5 text-black/70"><?= (int)$c['total_visits'] ?></span></td>
        <td class="p-3 text-right font-medium">$<?= number_format($c['total_spent'], 2) ?></td>
        <td class="p-3 text-center">
          <a href="/clients?edit=<?= (int)$c['id'] ?>" class="text-xs text-[#0071E3] hover:underline font-medium">Edit</a>
        </td>
      </tr>
    <?php endforeach; endif; ?>
    </tbody>
    </table>
  </div>
</div>
