<div class="apple-card p-6">
<div class="flex items-center justify-between mb-4"><div class="text-lg font-semibold">Client CRM</div><input class="input max-w-xs" placeholder="Search clients..."></div>
<table class="w-full text-sm">
<thead class="text-left text-xs uppercase text-black/50"><tr><th class="py-2">Name</th><th>Email</th><th>Phone</th><th>Visits</th><th>Spent</th><th>Favorite</th></tr></thead>
<tbody>
<?php if (empty($clients)): ?>
<tr><td colspan="6" class="text-center py-12 text-black/40">No clients yet.</td></tr>
<?php else: foreach ($clients as $c): ?>
<tr class="border-t border-black/5">
<td class="py-3 font-medium"><?= e($c['first_name'].' '.$c['last_name']) ?></td>
<td><?= e($c['email']) ?></td>
<td><?= e($c['phone']) ?></td>
<td><?= (int) $c['total_visits'] ?></td>
<td>$<?= number_format($c['total_spent'], 2) ?></td>
<td><?= $c['is_favorite'] ? '⭐' : '' ?></td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>
