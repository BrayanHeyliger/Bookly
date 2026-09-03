<form class="apple-card p-4 mb-4 flex items-end gap-3">
<div><label class="label">From</label><input type="date" class="input" name="from" value="<?= e($from) ?>"></div>
<div><label class="label">To</label><input type="date" class="input" name="to" value="<?= e($to) ?>"></div>
<button class="btn-primary">Apply</button>
<a href="#" class="btn-ghost text-sm">Export PDF</a>
<a href="#" class="btn-ghost text-sm">Export Excel</a>
</form>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
<div class="apple-card p-6"><div class="text-xs text-black/50">Revenue</div><div class="text-3xl font-semibold mt-1">$<?= number_format($revenue, 2) ?></div></div>
<div class="apple-card p-6"><div class="text-xs text-black/50">Bookings</div><div class="text-3xl font-semibold mt-1"><?= $count ?></div></div>
<div class="apple-card p-6"><div class="text-xs text-black/50">Avg ticket</div><div class="text-3xl font-semibold mt-1">$<?= $count ? number_format($revenue/$count, 2) : '0.00' ?></div></div>
</div>
<div class="apple-card p-6 mt-4">
<div class="text-lg font-semibold mb-3">Top services</div>
<table class="w-full text-sm">
<thead class="text-left text-xs uppercase text-black/50"><tr><th class="py-2">Service</th><th>Bookings</th><th>Revenue</th></tr></thead>
<tbody>
<?php foreach ($rows as $r): ?>
<tr class="border-t border-black/5">
<td class="py-3 font-medium"><?= e($r['service_name'] ?? '—') ?></td>
<td><?= $r['c'] ?></td>
<td>$<?= number_format($r['total'], 2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
