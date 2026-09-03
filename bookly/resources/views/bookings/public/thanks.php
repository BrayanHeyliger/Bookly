<div class="apple-card p-12 max-w-md text-center">
<div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-[#34C759] to-[#5AC8FA] mx-auto grid place-items-center text-white text-4xl mb-6">✓</div>
<h1 class="text-2xl font-semibold">You're booked!</h1>
<p class="text-black/50 mt-2">We sent a confirmation to your email. See you on <?= date('M j, Y \a\t H:i', strtotime($booking['start_at'])) ?>.</p>
<div class="mt-6 p-4 rounded-2xl bg-[#F5F5F7] text-left text-sm">
<div><strong>Service:</strong> <?= e($booking['service_name']) ?></div>
<div><strong>Reference:</strong> #<?= $booking['id'] ?></div>
</div>
</div>
