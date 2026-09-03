<style>
*, *::before, *::after { box-sizing: border-box; }
[x-cloak] { display: none !important; }
html, body { margin: 0; padding: 0; }

/* === Outer: full-bleed on mobile, centered card on desktop === */
.dm-shell { min-height: 100vh; min-height: 100dvh; background: #F5F5F7; display: flex; flex-direction: column; }
.dm-page { flex: 1; padding: 12px 12px 100px 12px; padding-bottom: calc(100px + env(safe-area-inset-bottom)); }
@media (min-width: 768px) { .dm-page { padding: 32px 24px 40px 24px; } }

/* === Inner card === */
.dm-card { background: #fff; border-radius: 20px; padding: 20px 16px; max-width: 640px; margin: 0 auto; box-shadow: 0 2px 16px rgba(0,0,0,0.04); }
@media (min-width: 768px) { .dm-card { padding: 40px; border-radius: 24px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); } }

/* === Header === */
.dm-header { text-align: center; margin-bottom: 20px; padding: 0 4px; }
.dm-logo { display: inline-grid; place-items: center; width: 56px; height: 56px; border-radius: 18px; background: linear-gradient(135deg, #0071E3, #5AC8FA); color: #fff; font-size: 22px; font-weight: 700; margin-bottom: 10px; box-shadow: 0 6px 18px rgba(0,113,227,0.25); }
@media (min-width: 768px) { .dm-logo { width: 80px; height: 80px; font-size: 30px; border-radius: 24px; } }
.dm-title { font-size: 22px; font-weight: 700; letter-spacing: -0.02em; margin: 0; color: #1D1D1F; }
@media (min-width: 768px) { .dm-title { font-size: 30px; } }
.dm-sub { color: rgba(0,0,0,0.5); margin: 4px 0 0; font-size: 14px; }

/* === Stepper === */
.dm-stepper { display: flex; align-items: center; justify-content: space-between; gap: 0; margin-bottom: 8px; padding: 0 4px; }
.dm-step { display: flex; align-items: center; gap: 6px; flex-shrink: 0; }
.dm-step-lbl { font-size: 11px; font-weight: 600; color: rgba(0,0,0,0.4); white-space: nowrap; transition: color .25s; }
.dm-step-lbl.on { color: #1D1D1F; }
@media (max-width: 639px) { .dm-step-lbl { display: none; } }
.dm-dot { width: 28px; height: 28px; border-radius: 999px; display: grid; place-items: center; font-size: 12px; font-weight: 600; background: #E5E5EA; color: #8E8E93; transition: all .3s cubic-bezier(.16,1,.3,1); flex-shrink: 0; }
@media (min-width: 768px) { .dm-dot { width: 32px; height: 32px; font-size: 13px; } }
.dm-dot.on { background: #0071E3; color: #fff; transform: scale(1.05); box-shadow: 0 0 0 4px rgba(0,113,227,0.15); }
.dm-dot.done { background: #34C759; color: #fff; }
.dm-conn { flex: 1; height: 2px; background: #E5E5EA; margin: 0 4px; border-radius: 999px; overflow: hidden; min-width: 8px; }
.dm-conn-fill { height: 100%; background: linear-gradient(90deg, #0071E3, #5AC8FA); width: 0%; transition: width .4s cubic-bezier(.16,1,.3,1); }
.dm-conn.done .dm-conn-fill { width: 100%; }

/* === Bar === */
.dm-bar { position: relative; height: 4px; background: #E5E5EA; border-radius: 999px; overflow: hidden; margin: 0 4px 20px; }
@media (min-width: 768px) { .dm-bar { margin-bottom: 32px; } }
.dm-bar-fill { position: absolute; left: 0; top: 0; bottom: 0; background: linear-gradient(90deg, #0071E3, #5AC8FA); transition: width .5s cubic-bezier(.16,1,.3,1); border-radius: 999px; }

/* === Step === */
.dm-stp { display: none; animation: dm-fadein .35s cubic-bezier(.16,1,.3,1); }
.dm-stp.on { display: block; }
@keyframes dm-fadein { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
.dm-stp-h { font-size: 20px; font-weight: 700; margin: 0 0 4px; color: #1D1D1F; letter-spacing: -0.01em; }
@media (min-width: 768px) { .dm-stp-h { font-size: 24px; } }
.dm-stp-sub { font-size: 14px; color: rgba(0,0,0,0.5); margin: 0 0 18px; }

/* === Service buttons: full width, BIG on mobile === */
.dm-svc-list { display: flex; flex-direction: column; gap: 10px; }
.dm-svc { width: 100%; text-align: left; background: #fff; border: 1.5px solid rgba(0,0,0,0.08); border-radius: 16px; padding: 16px; cursor: pointer; transition: all .2s cubic-bezier(.16,1,.3,1); display: flex; align-items: center; gap: 14px; min-height: 72px; -webkit-tap-highlight-color: transparent; }
@media (min-width: 768px) { .dm-svc { padding: 18px 20px; min-height: 76px; } }
.dm-svc:hover { border-color: #0071E3; background: #F5F9FF; }
.dm-svc:active { transform: scale(0.99); background: #E8F3FF; }
.dm-svc.sel { border-color: #0071E3; background: #E8F3FF; box-shadow: 0 0 0 3px rgba(0,113,227,0.12); }
.dm-svc-emoji { font-size: 32px; flex-shrink: 0; width: 52px; height: 52px; display: grid; place-items: center; background: #F5F5F7; border-radius: 14px; }
@media (min-width: 768px) { .dm-svc-emoji { font-size: 34px; width: 56px; height: 56px; } }
.dm-svc-info { flex: 1; min-width: 0; }
.dm-svc-name { font-weight: 600; font-size: 16px; color: #1D1D1F; line-height: 1.3; }
@media (min-width: 768px) { .dm-svc-name { font-size: 17px; } }
.dm-svc-meta { font-size: 13px; color: rgba(0,0,0,0.5); margin-top: 2px; }
.dm-svc-price { font-weight: 700; font-size: 18px; color: #0071E3; flex-shrink: 0; }
@media (min-width: 768px) { .dm-svc-price { font-size: 20px; } }
.dm-svc-check { width: 24px; height: 24px; border-radius: 999px; border: 2px solid rgba(0,0,0,0.12); display: grid; place-items: center; flex-shrink: 0; transition: all .2s; color: transparent; }
.dm-svc.sel .dm-svc-check { background: #0071E3; border-color: #0071E3; color: #fff; }

/* === Time slots: 3-col mobile, 4-5-6 desktop, grouped by daypart === */
.dm-slots-wrap { position: relative; }
.dm-slots-loading { color: rgba(0,0,0,0.5); font-size: 14px; padding: 20px 0; display: flex; align-items: center; gap: 8px; justify-content: center; }
.dm-spinner { width: 18px; height: 18px; border: 2px solid rgba(0,0,0,0.1); border-top-color: #0071E3; border-radius: 999px; animation: dm-spin 0.8s linear infinite; flex-shrink: 0; }
@keyframes dm-spin { to { transform: rotate(360deg); } }
.dm-day-group { margin-bottom: 18px; }
.dm-day-group:last-child { margin-bottom: 0; }
.dm-day-lbl { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(0,0,0,0.45); margin-bottom: 8px; padding-left: 4px; }
.dm-slots { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
@media (min-width: 480px) { .dm-slots { grid-template-columns: repeat(4, 1fr); } }
@media (min-width: 768px) { .dm-slots { grid-template-columns: repeat(5, 1fr); gap: 10px; } }
@media (min-width: 1024px) { .dm-slots { grid-template-columns: repeat(6, 1fr); } }
.dm-slot { padding: 14px 6px; border-radius: 12px; border: 1.5px solid rgba(0,0,0,0.08); background: #fff; cursor: pointer; font-weight: 600; font-size: 14px; transition: all .15s; min-height: 48px; -webkit-tap-highlight-color: transparent; text-align: center; }
@media (min-width: 768px) { .dm-slot { padding: 14px 8px; font-size: 15px; min-height: 50px; } }
.dm-slot:hover { border-color: #0071E3; background: #F5F9FF; }
.dm-slot:active { transform: scale(0.96); }
.dm-slot.sel { background: #0071E3; border-color: #0071E3; color: #fff; box-shadow: 0 4px 14px rgba(0,113,227,0.3); }

/* === Date input === */
.dm-date { width: 100%; padding: 16px; border-radius: 14px; border: 1.5px solid #E5E5EA; font-size: 16px; box-sizing: border-box; background: #fff; transition: all .2s; min-height: 56px; -webkit-appearance: none; appearance: none; }
.dm-date:focus { outline: none; border-color: #0071E3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }

/* === Form === */
.dm-form-grid { display: grid; grid-template-columns: 1fr; gap: 14px; }
@media (min-width: 768px) { .dm-form-grid { grid-template-columns: 1fr 1fr; } }
.dm-field { display: flex; flex-direction: column; }
.dm-lbl { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #1D1D1F; }
.dm-inp { width: 100%; padding: 16px; border-radius: 12px; border: 1.5px solid #E5E5EA; font-size: 16px; box-sizing: border-box; background: #fff; transition: all .2s; min-height: 52px; font-family: inherit; }
.dm-inp:focus { outline: none; border-color: #0071E3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
textarea.dm-inp { min-height: 88px; resize: vertical; }
.dm-inp::placeholder { color: rgba(0,0,0,0.3); }

/* === Sticky bottom action bar (iOS-style) === */
.dm-bar-action { position: fixed; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.92); backdrop-filter: saturate(180%) blur(20px); -webkit-backdrop-filter: saturate(180%) blur(20px); border-top: 1px solid rgba(0,0,0,0.08); padding: 12px 16px; padding-bottom: calc(12px + env(safe-area-inset-bottom)); z-index: 50; transform: translateY(0); transition: transform .3s cubic-bezier(.16,1,.3,1); }
.dm-bar-action.hidden { transform: translateY(100%); }
.dm-bar-inner { max-width: 640px; margin: 0 auto; display: flex; align-items: center; gap: 10px; }
.dm-back { background: none; border: none; color: #0071E3; font-size: 15px; font-weight: 500; cursor: pointer; padding: 12px 14px; min-height: 48px; border-radius: 12px; transition: all .2s; display: inline-flex; align-items: center; gap: 4px; -webkit-tap-highlight-color: transparent; }
.dm-back:hover { background: rgba(0,113,227,0.08); }
.dm-back:active { transform: scale(0.97); }
.dm-next { flex: 1; background: #0071E3; color: #fff; padding: 16px 20px; border-radius: 14px; font-weight: 600; border: none; cursor: pointer; font-size: 16px; display: inline-flex; align-items: center; justify-content: center; gap: 6px; min-height: 52px; transition: all .2s; -webkit-tap-highlight-color: transparent; box-shadow: 0 2px 10px rgba(0,113,227,0.25); }
.dm-next:hover { background: #0066CC; }
.dm-next:active { transform: scale(0.98); }
.dm-next:disabled { opacity: 0.4; cursor: not-allowed; box-shadow: none; }
.dm-next svg, .dm-back svg { transition: transform .2s; }
.dm-next:hover:not(:disabled) svg { transform: translateX(2px); }
.dm-back:hover svg { transform: translateX(-2px); }

/* On desktop, hide sticky bar and show inline actions */
@media (min-width: 768px) {
  .dm-bar-action { display: none; }
  .dm-page { padding-bottom: 40px; }
  .dm-actions-inline { display: flex; align-items: center; gap: 10px; margin-top: 24px; }
  .dm-actions-inline .dm-next { box-shadow: none; padding: 12px 24px; }
  .dm-actions-inline .dm-back { padding: 12px 16px; }
}
@media (max-width: 767px) { .dm-actions-inline { display: none; } }

/* === Footer === */
.dm-foot { text-align: center; font-size: 12px; color: rgba(0,0,0,0.4); margin-top: 24px; padding-bottom: env(safe-area-inset-bottom); }
.dm-foot a { color: #0071E3; text-decoration: none; font-weight: 500; }
.dm-foot a:hover { text-decoration: underline; }

/* === Error === */
.dm-err { color: #FF3B30; font-size: 14px; padding: 12px; background: #FFF5F5; border-radius: 12px; border: 1px solid rgba(255,59,48,0.2); }

@media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation: none !important; transition: none !important; } }
</style>

<div class="dm-shell" id="booklyDemo">
  <div class="dm-page">

    <!-- Language switcher -->
    <div style="display:flex; justify-content:flex-end; margin-bottom:8px; padding: 0 4px;">
      <?= \Bookly\Support\LanguageSwitcher::render() ?>
    </div>

    <!-- Card -->
    <div class="dm-card">

      <!-- Header -->
      <div class="dm-header">
        <div class="dm-logo">B</div>
        <h1 class="dm-title"><?= e($business['name']) ?></h1>
        <p class="dm-sub"><?= e($business['description'] ?? '') ?></p>
      </div>

      <!-- Stepper -->
      <div class="dm-stepper" id="dmStepper">
        <div class="dm-step">
          <div class="dm-dot on" data-dot="1">1</div>
          <div class="dm-step-lbl on" data-lbl="1"><?= t('book.step1.title') ?></div>
        </div>
        <div class="dm-conn" data-conn="1"><div class="dm-conn-fill"></div></div>
        <div class="dm-step">
          <div class="dm-dot" data-dot="2">2</div>
          <div class="dm-step-lbl" data-lbl="2"><?= t('book.step2.title') ?></div>
        </div>
        <div class="dm-conn" data-conn="2"><div class="dm-conn-fill"></div></div>
        <div class="dm-step">
          <div class="dm-dot" data-dot="3">3</div>
          <div class="dm-step-lbl" data-lbl="3"><?= t('book.step3.title') ?></div>
        </div>
        <div class="dm-conn" data-conn="3"><div class="dm-conn-fill"></div></div>
        <div class="dm-step">
          <div class="dm-dot" data-dot="4">4</div>
          <div class="dm-step-lbl" data-lbl="4"><?= t('book.step4.title') ?></div>
        </div>
      </div>
      <div class="dm-bar"><div class="dm-bar-fill" id="dmBar" style="width: 25%;"></div></div>

      <!-- STEP 1: choose service -->
      <div class="dm-stp on" data-step="1">
        <h2 class="dm-stp-h"><?= t('book.step1.title') ?></h2>
        <p class="dm-stp-sub"><?= t('book.step1.subtitle') ?></p>
        <div class="dm-svc-list">
          <?php foreach ($services as $s): $emojis = ['💇','🧔','🎨','✨','👶','💆','💅','🪒']; $em = $emojis[($s['id'] - 1) % count($emojis)]; ?>
          <button type="button" class="dm-svc" data-svc="<?= (int)$s['id'] ?>" data-name="<?= e($s['name']) ?>">
            <div class="dm-svc-emoji"><?= $em ?></div>
            <div class="dm-svc-info">
              <div class="dm-svc-name"><?= e($s['name']) ?></div>
              <div class="dm-svc-meta"><?= (int)$s['duration'] ?> <?= t('common.min') ?></div>
            </div>
            <div class="dm-svc-price">$<?= number_format((float)$s['price'], 2) ?></div>
            <div class="dm-svc-check"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7l3 3 5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- STEP 2: pick date -->
      <div class="dm-stp" data-step="2">
        <h2 class="dm-stp-h"><?= t('book.step2.title') ?></h2>
        <p class="dm-stp-sub"><?= t('book.step2.subtitle') ?></p>
        <input type="date" class="dm-date" id="dmDate" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" min="<?= date('Y-m-d') ?>">
        <div class="dm-actions-inline">
          <button type="button" class="dm-back" data-go="1"><?= t('book.back') ?></button>
          <button type="button" class="dm-next" id="dmGoStep3" style="flex:0 0 auto;"><?= t('book.next') ?> →</button>
        </div>
      </div>

      <!-- STEP 3: pick time -->
      <div class="dm-stp" data-step="3">
        <h2 class="dm-stp-h"><?= t('book.step3.title') ?></h2>
        <p class="dm-stp-sub"><?= t('book.step3.subtitle', ['date' => '']) ?><span id="dmDateLabel"></span>.</p>
        <div class="dm-slots-wrap" id="dmSlotsWrap">
          <div class="dm-slots-loading" id="dmLoading"><div class="dm-spinner"></div> <?= t('book.step3.loading') ?></div>
          <div id="dmSlots" style="display:none;"></div>
        </div>
        <div class="dm-actions-inline">
          <button type="button" class="dm-back" data-go="2"><?= t('book.back') ?></button>
        </div>
      </div>

      <!-- STEP 4: details -->
      <div class="dm-stp" data-step="4">
        <h2 class="dm-stp-h"><?= t('book.step4.title') ?></h2>
        <p class="dm-stp-sub"><?= t('book.step4.subtitle') ?></p>
        <form method="POST" action="/book/<?= e($business['slug']) ?>" id="dmForm">
          <?= csrf_field() ?>
          <input type="hidden" name="service_id" id="dmServiceId">
          <input type="hidden" name="date" id="dmFormDate">
          <input type="hidden" name="time" id="dmFormTime">
          <div class="dm-form-grid">
            <div class="dm-field"><label class="dm-lbl"><?= t('book.firstname') ?></label><input class="dm-inp" name="first_name" required autocomplete="given-name"></div>
            <div class="dm-field"><label class="dm-lbl"><?= t('book.lastname') ?></label><input class="dm-inp" name="last_name" required autocomplete="family-name"></div>
          </div>
          <div class="dm-field" style="margin-top:14px;"><label class="dm-lbl"><?= t('book.email') ?></label><input class="dm-inp" name="email" type="email" required autocomplete="email" inputmode="email"></div>
          <div class="dm-field" style="margin-top:14px;"><label class="dm-lbl"><?= t('book.phone') ?></label><input class="dm-inp" name="phone" type="tel" autocomplete="tel" inputmode="tel"></div>
          <div class="dm-field" style="margin-top:14px;"><label class="dm-lbl"><?= t('book.notes') ?></label><textarea class="dm-inp" name="notes" rows="2"></textarea></div>
          <div class="dm-actions-inline">
            <button type="button" class="dm-back" data-go="3"><?= t('book.back') ?></button>
            <button type="submit" class="dm-next" style="flex:0 0 auto;"><?= t('book.confirm') ?> ✓</button>
          </div>
        </form>
      </div>

    </div>

    <div class="dm-foot"><?= t('book.powered') ?> <a href="/">Bookly</a></div>
  </div>

  <!-- Sticky bottom action bar (mobile only, hidden on desktop) -->
  <div class="dm-bar-action" id="dmSticky">
    <div class="dm-bar-inner" id="dmStickyInner">
      <button type="button" class="dm-back" id="dmStickyBack" style="display:none;">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 4l-4 4 4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?= t('book.back') ?>
      </button>
      <button type="button" class="dm-next" id="dmStickyNext"><?= t('book.next') ?> →</button>
    </div>
  </div>
</div>

<script>
(function() {
  var root = document.getElementById('booklyDemo');
  if (!root) return;
  var step = 1;
  var state = { service: null, serviceName: '', date: root.querySelector('#dmDate').value, time: null };
  var biz = <?= json_encode($business['slug']) ?>;
  var isMobile = window.matchMedia('(max-width: 767px)').matches;

  function $(s, ctx) { return (ctx || root).querySelector(s); }
  function $$(s, ctx) { return Array.prototype.slice.call((ctx || root).querySelectorAll(s)); }

  function go(n) {
    if (n < 1 || n > 4 || n === step) return;
    var prev = step; step = n;

    $$('.dm-stp', root).forEach(function(el) {
      el.classList.toggle('on', parseInt(el.getAttribute('data-step'), 10) === n);
    });

    $$('[data-dot]', root).forEach(function(d) {
      var dn = parseInt(d.getAttribute('data-dot'), 10);
      d.classList.remove('on', 'done');
      if (dn < n) { d.classList.add('done'); d.innerHTML = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M3 7l3 3 5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'; }
      else if (dn === n) { d.classList.add('on'); d.textContent = dn; }
      else { d.textContent = dn; }
    });

    $$('[data-lbl]', root).forEach(function(l) {
      var ln = parseInt(l.getAttribute('data-lbl'), 10);
      l.classList.toggle('on', ln <= n);
    });

    $$('[data-conn]', root).forEach(function(c) {
      var cn = parseInt(c.getAttribute('data-conn'), 10);
      c.classList.remove('done');
      if (cn < n) c.classList.add('done');
    });

    var bar = $('#dmBar', root);
    if (bar) bar.style.width = (n * 25) + '%';

    if (n === 3) loadSlots();
    if (n === 4) syncForm();
    updateSticky();
  }

  function updateSticky() {
    if (!isMobile) return;
    var sticky = $('#dmSticky', root);
    var back = $('#dmStickyBack', root);
    var next = $('#dmStickyNext', root);
    if (!sticky) return;
    if (step === 1) { back.style.display = 'none'; next.style.flex = '1'; next.textContent = '<?= t('book.next') ?> →'; next.disabled = !state.service; next.onclick = function() { if (state.service) go(2); }; }
    else if (step === 2) { back.style.display = 'inline-flex'; next.style.flex = '1'; next.textContent = '<?= t('book.next') ?> →'; next.disabled = false; next.onclick = function() { state.date = $('#dmDate', root).value; go(3); }; }
    else if (step === 3) { back.style.display = 'inline-flex'; next.style.display = 'none'; }
    else if (step === 4) { back.style.display = 'inline-flex'; next.style.display = 'inline-flex'; next.style.flex = '1'; next.textContent = '<?= t('book.confirm') ?> ✓'; next.disabled = false; next.onclick = function() { syncForm(); $('#dmForm', root).submit(); }; }
  }

  function loadSlots() {
    var loading = $('#dmLoading', root);
    var slots = $('#dmSlots', root);
    var dateLabel = $('#dmDateLabel', root);
    if (dateLabel) dateLabel.textContent = state.date;
    loading.style.display = 'flex';
    slots.style.display = 'none';
    slots.innerHTML = '';
    fetch('/api/slots/' + encodeURIComponent(biz) + '/' + state.service + '/' + state.date)
      .then(function(r) { return r.json(); })
      .then(function(data) {
        loading.style.display = 'none';
        if (!data || data.length === 0) {
          slots.style.display = 'block';
          slots.innerHTML = '<div class="dm-err" style="margin-top:8px;">' + LBL_NO_SLOTS + '</div>';
          return;
        }
        slots.style.display = 'block';
        var groups = { morning: [], afternoon: [], evening: [] };
        for (var i = 0; i < data.length; i++) {
          var h = parseInt(data[i].split(':')[0], 10);
          if (h < 12) groups.morning.push(data[i]);
          else if (h < 18) groups.afternoon.push(data[i]);
          else groups.evening.push(data[i]);
        }
        var html = '';
        if (groups.morning.length) html += '<div class="dm-day-group"><div class="dm-day-lbl">🌅 ' + LBL_MORNING + '</div><div class="dm-slots">' + renderSlots(groups.morning) + '</div></div>';
        if (groups.afternoon.length) html += '<div class="dm-day-group"><div class="dm-day-lbl">☀️ ' + LBL_AFTERNOON + '</div><div class="dm-slots">' + renderSlots(groups.afternoon) + '</div></div>';
        if (groups.evening.length) html += '<div class="dm-day-group"><div class="dm-day-lbl">🌙 ' + LBL_EVENING + '</div><div class="dm-slots">' + renderSlots(groups.evening) + '</div></div>';
        slots.innerHTML = html;
        bindSlots();
      })
      .catch(function() {
        loading.style.display = 'none';
        slots.style.display = 'block';
        slots.innerHTML = '<div class="dm-err" style="margin-top:8px;">' + LBL_ERR_SLOTS + '</div>';
      });
  }

  function renderSlots(arr) {
    return arr.map(function(t) { return '<button type="button" class="dm-slot" data-time="' + t + '">' + t + '</button>'; }).join('');
  }

  function bindSlots() {
    $$('.dm-slot', root).forEach(function(b) {
      b.addEventListener('click', function() {
        state.time = this.getAttribute('data-time');
        $$('.dm-slot', root).forEach(function(s) { s.classList.remove('sel'); });
        this.classList.add('sel');
        setTimeout(function() { go(4); }, 220);
      });
    });
  }

  function syncForm() {
    var sid = $('#dmServiceId', root);
    var fd = $('#dmFormDate', root);
    var ft = $('#dmFormTime', root);
    if (sid) sid.value = state.service || '';
    if (fd) fd.value = state.date || '';
    if (ft) ft.value = state.time || '';
  }

  // Service selection
  $$('.dm-svc', root).forEach(function(b) {
    b.addEventListener('click', function() {
      state.service = parseInt(this.getAttribute('data-svc'), 10);
      state.serviceName = this.getAttribute('data-name') || '';
      $$('.dm-svc', root).forEach(function(s) { s.classList.remove('sel'); });
      this.classList.add('sel');
      var inline = $('#dmGoStep2', root);
      if (inline) inline.disabled = false;
      updateSticky();
    });
  });

  // Desktop inline: step 1→2 (only used on desktop since sticky is mobile)
  var go2 = $('#dmGoStep2', root);
  if (go2) go2.addEventListener('click', function() { if (state.service) go(2); });
  var go3 = $('#dmGoStep3', root);
  if (go3) go3.addEventListener('click', function() { state.date = $('#dmDate', root).value; go(3); });

  // Back buttons (desktop inline)
  $$('.dm-back', root).forEach(function(b) {
    if (b.id === 'dmStickyBack') return;
    b.addEventListener('click', function() {
      var t = parseInt(this.getAttribute('data-go'), 10);
      if (t) go(t);
    });
  });

  // Sticky back
  var sb = $('#dmStickyBack', root);
  if (sb) sb.addEventListener('click', function() { if (step > 1) go(step - 1); });

  // Submit sync
  var form = $('#dmForm', root);
  if (form) form.addEventListener('submit', function() { syncForm(); });

  // Date change
  var dateInput = $('#dmDate', root);
  if (dateInput) dateInput.addEventListener('change', function() { state.date = this.value; });

  // Re-check mobile on resize
  window.addEventListener('resize', function() {
    isMobile = window.matchMedia('(max-width: 767px)').matches;
    updateSticky();
  });

  // Initial
  go(1);
})();
</script>
