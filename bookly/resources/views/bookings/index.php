<div class="apple-card p-6">
<div class="flex items-center justify-between mb-4">
<form class="flex gap-2">
<select class="input py-2" name="status" onchange="this.form.submit()">
<option value="">All statuses</option>
<?php foreach (['pending','confirmed','completed','cancelled'] as $s): ?>
<option value="<?= $s ?>" <?= ($_GET['status'] ?? '') === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
<?php endforeach; ?>
</select>
</form>
<a href="/addons" class="btn-primary text-sm">+ New booking</a>
</div>
<div class="overflow-x-auto">
<table class="w-full text-sm">
<thead class="text-left text-xs uppercase text-black/50"><tr><th class="py-2">When</th><th>Client</th><th>Service</th><th>Staff</th><th>Status</th><th>Price</th><th></th></tr></thead>
<tbody>
<?php if (empty($bookings)): ?>
<tr><td colspan="7" class="text-center py-12 text-black/40">No bookings yet.</td></tr>
<?php else: foreach ($bookings as $b): ?>
<tr class="border-t border-black/5">
<td class="py-3"><?= date('M j, H:i', strtotime($b['start_at'])) ?></td>
<td><?= e($b['client_name'] ?? '—') ?></td>
<td><?= e($b['service_name'] ?? '—') ?></td>
<td><?= e($b['staff_name'] ?? '—') ?></td>
<td><span class="pill bg-black/5"><?= ucfirst($b['status']) ?></span></td>
<td class="font-medium">$<?= number_format($b['price'], 2) ?></td>
<td><a href="/bookings/<?= $b['id'] ?>" class="text-[#0071E3] text-xs">View</a></td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>
</div>
