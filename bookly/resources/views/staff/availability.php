<?php
$days = ['monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday', 'saturday' => 'Saturday', 'sunday' => 'Sunday'];
$availability = $availability ?? [];
?>
<div class="space-y-6">

  <div class="apple-card p-6">
    <div class="text-lg font-semibold mb-1">Availability</div>
    <p class="text-sm text-black/50 mb-5">Weekly hours for each team member. Mark a day closed if they do not work it.</p>
    <form method="POST" action="/staff/availability" class="space-y-5">
      <?= csrf_field() ?>
      <?php if (empty($staff)): ?>
        <div class="text-sm text-black/40 py-6 text-center">Add a staff member first.</div>
      <?php else: foreach ($staff as $s): ?>
        <div class="p-4 rounded-2xl border border-black/5">
          <div class="flex items-center justify-between mb-3">
            <div class="font-medium"><?= e($s['name']) ?></div>
            <span class="pill text-[10px] bg-[#E8F3FF] text-[#0071E3]"><?= e(ucfirst($s['role_in_business'] ?? 'staff')) ?></span>
          </div>
          <div class="space-y-2">
            <?php foreach ($days as $key => $label):
              $row = $availability[(int)$s['id']][$key] ?? ['open' => '09:00', 'close' => '18:00', 'is_closed' => 0];
            ?>
              <div class="flex items-center gap-3">
                <div class="w-24 text-sm text-black/60"><?= $label ?></div>
                <input type="time" name="staff[<?= (int)$s['id'] ?>][<?= $key ?>][open]" value="<?= e(substr($row['open'] ?? '09:00', 0, 5)) ?>" class="input py-1.5 text-sm" style="max-width:130px;">
                <span class="text-black/30">to</span>
                <input type="time" name="staff[<?= (int)$s['id'] ?>][<?= $key ?>][close]" value="<?= e(substr($row['close'] ?? '18:00', 0, 5)) ?>" class="input py-1.5 text-sm" style="max-width:130px;">
                <label class="flex items-center gap-1.5 text-xs text-black/50">
                  <input type="checkbox" name="staff[<?= (int)$s['id'] ?>][<?= $key ?>][closed]" <?= ! empty($row['is_closed']) ? 'checked' : '' ?> class="rounded accent-[#0071E3]"> Closed
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; endif; ?>
      <button type="submit" class="btn-primary">Save availability</button>
    </form>
  </div>

  <div class="apple-card p-6 max-w-3xl">
    <div class="text-lg font-semibold mb-1">Business opening hours</div>
    <p class="text-sm text-black/50 mb-5">These govern the slots clients can see. Edit them under <a href="/hours" class="text-[#0071E3]">Hours</a>.</p>
    <div class="space-y-2">
      <?php foreach ($days as $key => $label): $h = $hours[$key] ?? null; ?>
        <div class="flex items-center justify-between py-2 border-b border-black/5 last:border-0 text-sm">
          <span class="text-black/60"><?= $label ?></span>
          <?php if (! $h || ! empty($h['is_closed'])): ?>
            <span class="text-black/30">Closed</span>
          <?php else: ?>
            <span class="font-medium"><?= e(substr($h['open'], 0, 5)) ?> - <?= e(substr($h['close'], 0, 5)) ?></span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
