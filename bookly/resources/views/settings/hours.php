<div class="apple-card p-6 max-w-3xl">
  <div class="text-lg font-semibold mb-1">Business Hours</div>
  <p class="text-sm text-black/50 mb-6">Set your weekly opening hours. Clients will only see available slots during these times.</p>
  <form method="POST" action="/hours" class="space-y-3">
    <?= csrf_field() ?>
    <?php
    $days = ['monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday', 'saturday' => 'Saturday', 'sunday' => 'Sunday'];
    foreach ($days as $key => $label):
        $h = $hours[$key] ?? ['open' => '09:00', 'close' => '18:00', 'is_closed' => 0];
    ?>
    <div class="flex items-center gap-3 p-3 rounded-2xl border border-black/5 hover:border-black/10 transition">
      <div class="w-24 font-medium text-sm"><?= $label ?></div>
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" name="<?= $key ?>_closed" <?= $h['is_closed'] ? 'checked' : '' ?> class="w-4 h-4 rounded accent-[#0071E3]">
        <span class="text-xs text-black/50">Closed</span>
      </label>
      <div class="flex-1 flex items-center gap-2">
        <input type="time" name="<?= $key ?>_open" value="<?= e($h['open']) ?>" class="input text-sm py-2" style="max-width:140px;">
        <span class="text-black/30">→</span>
        <input type="time" name="<?= $key ?>_close" value="<?= e($h['close']) ?>" class="input text-sm py-2" style="max-width:140px;">
      </div>
    </div>
    <?php endforeach; ?>
    <div class="pt-4 flex gap-3">
      <button type="submit" class="btn-primary">Save hours</button>
      <button type="reset" class="btn-ghost">Reset</button>
    </div>
  </form>
</div>
