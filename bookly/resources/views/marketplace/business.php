<style>
.biz-hero { position:relative; height:280px; background:linear-gradient(135deg, #0071E3, #5AC8FA); display:flex; align-items:flex-end; padding:32px; color:#fff; }
.biz-hero-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.4), transparent); }
.biz-hero-content { position:relative; z-index:1; }
.svc-card { background:#fff; border-radius:16px; padding:20px; border:1px solid rgba(0,0,0,0.06); transition:all .2s; }
.svc-card:hover { box-shadow:0 4px 16px rgba(0,0,0,0.08); }
.review-card { background:#fff; border-radius:16px; padding:20px; border:1px solid rgba(0,0,0,0.06); }
.star { color:#FF9500; }
</style>

<div class="biz-hero">
  <div class="biz-hero-overlay"></div>
  <div class="biz-hero-content">
    <div class="text-3xl font-bold"><?= e($business['name']) ?></div>
    <div class="text-white/80 mt-1"><?= e($business['category'] ?? '') ?> · <?= e($business['city'] ?? '') ?></div>
    <div class="flex items-center gap-3 mt-3">
      <span class="star"><?= str_repeat('⭐', (int) round($avg_rating)) ?></span>
      <span class="text-white/90 text-sm"><?= number_format($avg_rating, 1) ?> (<?= (int)$review_count ?> reviews)</span>
      <a href="/book/<?= e($business['slug']) ?>" class="ml-auto px-5 py-2.5 rounded-full bg-white text-[#0071E3] font-semibold text-sm hover:bg-gray-100 transition">Book now</a>
    </div>
  </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-8">
  <?php if (!empty($business['description'])): ?>
  <div class="apple-card p-6 mb-6">
    <div class="text-sm text-black/50 uppercase tracking-wide mb-2">About</div>
    <p class="text-base text-black/80 leading-relaxed"><?= e($business['description']) ?></p>
  </div>
  <?php endif; ?>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
      <div class="apple-card p-6">
        <div class="text-lg font-semibold mb-4">Services</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <?php foreach ($services as $s): ?>
          <div class="svc-card">
            <div class="flex items-start justify-between">
              <div>
                <div class="font-semibold text-sm"><?= e($s['name']) ?></div>
                <div class="text-xs text-black/50 mt-1"><?= (int)$s['duration'] ?> min</div>
              </div>
              <div class="font-semibold text-[#0071E3]">$<?= number_format($s['price'], 2) ?></div>
            </div>
            <?php if (!empty($s['description'])): ?><div class="text-xs text-black/60 mt-2"><?= e($s['description']) ?></div><?php endif; ?>
            <a href="/book/<?= e($business['slug']) ?>" class="inline-block mt-3 text-xs font-semibold text-[#0071E3] hover:underline">Book →</a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="apple-card p-6">
        <div class="text-lg font-semibold mb-4">Reviews (<?= (int)$review_count ?>)</div>
        <?php if (empty($reviews)): ?>
          <div class="text-sm text-black/40">No reviews yet. Be the first to book and review!</div>
        <?php else: foreach ($reviews as $r): ?>
          <div class="review-card mb-3 last:mb-0">
            <div class="flex items-center justify-between">
              <div class="font-semibold text-sm"><?= e($r['user_name'] ?? 'Client') ?></div>
              <div class="star text-xs"><?= str_repeat('⭐', (int)($r['rating'] ?? 5)) ?></div>
            </div>
            <?php if (!empty($r['comment'])): ?><p class="text-sm text-black/70 mt-2"><?= e($r['comment']) ?></p><?php endif; ?>
            <div class="text-xs text-black/30 mt-2"><?= date('M j, Y', strtotime($r['created_at'])) ?></div>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>

    <div class="space-y-4">
      <div class="apple-card p-6">
        <div class="text-sm font-semibold mb-3">Contact</div>
        <div class="space-y-2 text-sm">
          <?php if (!empty($business['phone'])): ?><div class="flex items-center gap-2"><span>📞</span> <?= e($business['phone']) ?></div><?php endif; ?>
          <?php if (!empty($business['email'])): ?><div class="flex items-center gap-2"><span>✉️</span> <?= e($business['email']) ?></div><?php endif; ?>
          <?php if (!empty($business['address'])): ?><div class="flex items-center gap-2"><span>📍</span> <?= e($business['address']) ?></div><?php endif; ?>
        </div>
      </div>
      <a href="/book/<?= e($business['slug']) ?>" class="block text-center btn-primary" style="padding:14px 24px; border-radius:999px; font-weight:600;">Book an appointment</a>
    </div>
  </div>
</div>
