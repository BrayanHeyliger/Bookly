<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 slide-up">
<div class="apple-card p-6"><div class="text-xs uppercase tracking-wide text-black/50 font-medium">Bookings today</div><div class="text-4xl font-semibold mt-2"><?= $todayBookings ?></div><div class="mt-3 text-sm text-[#34C759]">▲ Live data</div></div>
<div class="apple-card p-6"><div class="text-xs uppercase tracking-wide text-black/50 font-medium">Revenue (week)</div><div class="text-4xl font-semibold mt-2">$<?= number_format($weekRevenue, 0) ?></div><div class="mt-3 text-sm text-black/50">Mon–Sun</div></div>
<div class="apple-card p-6"><div class="text-xs uppercase tracking-wide text-black/50 font-medium">New clients (30d)</div><div class="text-4xl font-semibold mt-2"><?= $newClients ?></div><div class="mt-3 text-sm text-black/50">Acquired</div></div>
<div class="apple-card p-6"><div class="text-xs uppercase tracking-wide text-black/50 font-medium">Addons</div><div class="text-4xl font-semibold mt-2"><?= $addonsInstalled ?><span class="text-black/30 text-2xl">/<?= $addonsTotal ?></span></div><div class="mt-3 text-sm"><a href="/addons" class="text-[#0071E3]">Explore marketplace →</a></div></div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6">
<div class="apple-card p-6 lg:col-span-2">
<div class="flex items-center justify-between mb-4"><div><div class="text-sm text-black/50">Last 14 days</div><div class="text-lg font-semibold">Bookings & revenue</div></div></div>
<div style="position: relative; height: 260px;"><canvas id="chart"></canvas></div>
</div>
<div class="apple-card p-6">
<div class="text-sm text-black/50">Today</div><div class="text-lg font-semibold mb-4">Upcoming</div>
<div class="space-y-3">
<?php if (empty($upcoming)): ?>
<div class="text-sm text-black/40">No upcoming bookings.</div>
<?php else: foreach ($upcoming as $b): ?>
<div class="flex items-center justify-between p-3 rounded-2xl bg-[#F5F5F7]">
<div><div class="font-medium text-sm"><?= e($b['service_name'] ?? '—') ?></div><div class="text-xs text-black/50"><?= e($b['client_name'] ?? 'Walk-in') ?> · <?= e($b['staff_name'] ?? 'Any') ?></div></div>
<div class="text-sm font-semibold text-[#0071E3]"><?= date('H:i', strtotime($b['start_at'])) ?></div>
</div>
<?php endforeach; endif; ?>
</div>
</div>
</div>
<div class="apple-card p-6 mt-6">
<div class="flex items-center justify-between mb-4"><div class="text-lg font-semibold">Recent activity</div><a href="/bookings" class="text-sm text-[#0071E3]">View all →</a></div>
<div class="overflow-x-auto">
<table class="w-full text-sm">
<thead class="text-left text-black/50 text-xs uppercase"><tr><th class="py-2">When</th><th>Client</th><th>Service</th><th>Status</th><th>Price</th></tr></thead>
<tbody>
<?php foreach ($recent as $b): ?>
<tr class="border-t border-black/5">
<td class="py-3"><?= date('M j, H:i', strtotime($b['start_at'])) ?></td>
<td><?= e($b['client_name'] ?? '—') ?></td>
<td><?= e($b['service_name'] ?? '—') ?></td>
<td><span class="pill <?= $b['status'] === 'completed' ? 'bg-[#E8F8EE] text-[#34C759]' : 'bg-[#E8F3FF] text-[#0071E3]' ?>"><?= ucfirst($b['status']) ?></span></td>
<td class="font-medium">$<?= number_format($b['price'], 0) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<script>
window.addEventListener('load', () => {
  const ctx = document.getElementById('chart');
  if (!ctx) return;
  const data = <?= json_encode($chart) ?>;
  const labels = data.map(d => { const dt = new Date(d.day); return dt.toLocaleDateString('en-US',{month:'short',day:'numeric'}); });
  const counts = data.map(d => d.c);
  const totals = data.map(d => d.total);
  new Chart(ctx, {
    type: 'line',
    data: { labels, datasets: [
      { label: 'Bookings', data: counts, borderColor: '#0071E3', backgroundColor: 'rgba(0,113,227,0.1)', tension: 0.4, fill: true, yAxisID: 'y' },
      { label: 'Revenue',  data: totals, borderColor: '#34C759', backgroundColor: 'rgba(52,199,89,0.1)', tension: 0.4, fill: false, yAxisID: 'y1' },
    ]},
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: {
      y:  { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
      y1: { beginAtZero: true, position: 'right', grid: { display: false } }
    }}
  });
});
</script>
