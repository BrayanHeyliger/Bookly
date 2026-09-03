<div class="apple-card overflow-hidden">
  <div class="p-6 border-b border-black/5 flex items-center justify-between">
    <div>
      <div class="text-lg font-semibold">Notifications</div>
      <p class="text-sm text-black/50 mt-1">System alerts, booking confirmations and reminders</p>
    </div>
    <form method="POST" action="/notifications" class="inline">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="mark_all_read">
      <button type="submit" class="btn-ghost text-sm">Mark all as read</button>
    </form>
  </div>
  <div class="divide-y divide-black/5">
  <?php if (empty($notifications)): ?>
    <div class="p-10 text-center text-black/40">No notifications yet.</div>
  <?php else: foreach ($notifications as $n): ?>
    <div class="p-4 hover:bg-black/[0.02] transition flex items-start gap-4">
      <div class="w-10 h-10 rounded-full grid place-items-center text-lg flex-shrink-0" style="background: <?= $n['is_read'] ? '#F5F5F7' : '#E8F3FF' ?>;">
        <?= $n['type'] === 'booking' ? '📅' : ($n['type'] === 'payment' ? '💳' : ($n['type'] === 'alert' ? '🔔' : 'ℹ️')) ?>
      </div>
      <div class="flex-1 min-w-0">
        <div class="text-sm font-medium <?= $n['is_read'] ? 'text-black/70' : 'text-[#1D1D1F]' ?>"><?= e($n['title'] ?? 'Notification') ?></div>
        <div class="text-sm text-black/50 mt-0.5"><?= e($n['message'] ?? '') ?></div>
        <div class="text-xs text-black/30 mt-1"><?= date('M j, H:i', strtotime($n['created_at'])) ?></div>
      </div>
      <?php if (! $n['is_read']): ?><div class="w-2 h-2 rounded-full bg-[#0071E3] mt-2 flex-shrink-0"></div><?php endif; ?>
    </div>
  <?php endforeach; endif; ?>
  </div>
</div>
