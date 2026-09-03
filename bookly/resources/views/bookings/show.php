<div class="apple-card p-6 max-w-2xl">
<div class="flex items-center justify-between mb-4">
<div><div class="text-xs text-black/50">Booking #<?= $booking['id'] ?></div><div class="text-2xl font-semibold"><?= e($booking['service_name'] ?? '—') ?></div></div>
<span class="pill bg-black/5"><?= ucfirst($booking['status']) ?></span>
</div>
<div class="grid grid-cols-2 gap-4 text-sm">
<div><div class="text-black/50 text-xs">Client</div><?= e(($booking['client_name'] ?? '').' '.($booking['client_last'] ?? '')) ?></div>
<div><div class="text-black/50 text-xs">Staff</div><?= e($booking['staff_name'] ?? '—') ?></div>
<div><div class="text-black/50 text-xs">Start</div><?= date('M j, Y H:i', strtotime($booking['start_at'])) ?></div>
<div><div class="text-black/50 text-xs">End</div><?= date('M j, Y H:i', strtotime($booking['end_at'])) ?></div>
<div><div class="text-black/50 text-xs">Price</div>$<?= number_format($booking['price'], 2) ?></div>
<div><div class="text-black/50 text-xs">Payment</div><?= ucfirst($booking['payment_status']) ?></div>
</div>
<?php if (! empty($booking['notes'])): ?>
<div class="mt-4 p-3 rounded-xl bg-[#F5F5F7] text-sm"><strong>Notes:</strong> <?= e($booking['notes']) ?></div>
<?php endif; ?>
<form method="POST" action="/bookings/<?= $booking['id'] ?>" class="mt-6">
<?= csrf_field() ?><input type="hidden" name="_method" value="DELETE">
<button class="text-sm text-[#FF3B30]">Delete booking</button>
</form>
</div>
