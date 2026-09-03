<style>
[x-cloak] { display: none !important; }
.stp { display: none; }
.stp.active { display: block; }
.dot { width: 32px; height: 32px; border-radius: 999px; display: grid; place-items: center; font-size: 12px; font-weight: 600; background: #E5E5EA; color: #8E8E93; transition: all .25s; }
.dot.active { background: #0071E3; color: #fff; }
.dot.done { background: #34C759; color: #fff; }
.dot.current { box-shadow: 0 0 0 4px rgba(0,113,227,0.15); }
.bar-track { position: relative; height: 4px; background: #E5E5EA; border-radius: 999px; overflow: hidden; }
.bar-fill { position: absolute; left: 0; top: 0; bottom: 0; background: linear-gradient(90deg, #0071E3, #5AC8FA); transition: width .4s ease; border-radius: 999px; }
.svc-btn { width: 100%; text-align: left; padding: 16px; border-radius: 16px; border: 1px solid rgba(0,0,0,0.1); background: #fff; cursor: pointer; transition: all .2s; }
.svc-btn:hover { border-color: #0071E3; background: #E8F3FF; }
.svc-btn.selected { border-color: #0071E3; background: #E8F3FF; }
.slot-btn { padding: 12px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.1); background: #fff; cursor: pointer; font-weight: 500; transition: all .2s; }
.slot-btn:hover { border-color: #0071E3; background: #E8F3FF; }
.slot-btn.selected { border-color: #0071E3; background: #0071E3; color: #fff; }
.inp { width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #E5E5EA; font-size: 14px; box-sizing: border-box; }
.inp:focus { outline: none; border-color: #0071E3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
.lbl { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; }
.btn-back { background: none; border: none; color: rgba(0,0,0,0.5); font-size: 14px; cursor: pointer; padding: 8px 12px; }
.btn-next { background: #0071E3; color: #fff; padding: 12px 24px; border-radius: 12px; font-weight: 500; border: none; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; }
.btn-next:hover { background: #0066CC; }
.btn-next:disabled { opacity: 0.5; cursor: not-allowed; }
</style>

<div class="max-w-2xl mx-auto" id="booklyDemo">
  <!-- Language switcher -->
  <div class="flex justify-end mb-4">
    <?= \Bookly\Support\LanguageSwitcher::render() ?>
  </div>

  <!-- Header -->
  <div class="text-center mb-8">
    <div style="display:inline-grid; place-items:center; width:80px; height:80px; border-radius:24px; background:linear-gradient(135deg,#0071E3,#5AC8FA); color:#fff; font-size:30px; font-weight:700; margin-bottom:16px;">B</div>
    <h1 style="font-size:30px; font-weight:600; letter-spacing:-0.02em; margin:0;"><?= e($business['name']) ?></h1>
    <p style="color:rgba(0,0,0,0.5); margin-top:4px;"><?= e($business['description'] ?? '') ?></p>
  </div>

  <!-- Stepper -->
  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
    <div style="display:flex; align-items:center; gap:8px;">
      <span class="dot active" data-dot="1">1</span>
      <span style="font-size:12px; font-weight:500; color:#1D1D1F;" data-lbl="1"><?= t('book.step1.title') ?></span>
    </div>
    <div style="flex:1; height:2px; background:#E5E5EA; margin:0 12px;"></div>
    <div style="display:flex; align-items:center; gap:8px;">
      <span class="dot" data-dot="2">2</span>
      <span style="font-size:12px; font-weight:500; color:rgba(0,0,0,0.4);" data-lbl="2"><?= t('book.step2.title') ?></span>
    </div>
    <div style="flex:1; height:2px; background:#E5E5EA; margin:0 12px;"></div>
    <div style="display:flex; align-items:center; gap:8px;">
      <span class="dot" data-dot="3">3</span>
      <span style="font-size:12px; font-weight:500; color:rgba(0,0,0,0.4);" data-lbl="3"><?= t('book.step3.title') ?></span>
    </div>
    <div style="flex:1; height:2px; background:#E5E5EA; margin:0 12px;"></div>
    <div style="display:flex; align-items:center; gap:8px;">
      <span class="dot" data-dot="4">4</span>
      <span style="font-size:12px; font-weight:500; color:rgba(0,0,0,0.4);" data-lbl="4"><?= t('book.step4.title') ?></span>
    </div>
  </div>
  <div class="bar-track mb-8">
    <div class="bar-fill" id="booklyBar" style="width: 25%;"></div>
  </div>

  <!-- Card -->
  <div class="apple-card" style="padding:32px;">

    <!-- STEP 1: choose service -->
    <div class="stp active" data-step="1">
      <h2 style="font-size:20px; font-weight:600; margin:0 0 4px;"><?= t('book.step1.title') ?></h2>
      <p style="font-size:14px; color:rgba(0,0,0,0.5); margin:0 0 16px;"><?= t('book.step1.subtitle') ?></p>
      <div style="display:flex; flex-direction:column; gap:8px;">
        <?php foreach ($services as $s): ?>
        <button type="button" class="svc-btn" data-svc="<?= (int)$s['id'] ?>" data-name="<?= e($s['name']) ?>">
          <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
              <div style="font-weight:500;"><?= e($s['name']) ?></div>
              <div style="font-size:14px; color:rgba(0,0,0,0.5);"><?= (int)$s['duration'] ?> <?= t('common.min') ?></div>
            </div>
            <div style="font-weight:600;">$<?= number_format((float)$s['price'], 2) ?></div>
          </div>
        </button>
        <?php endforeach; ?>
      </div>
      <div style="display:flex; justify-content:flex-end; margin-top:24px;">
        <button type="button" class="btn-next" id="goStep2" disabled><?= t('book.next') ?></button>
      </div>
    </div>

    <!-- STEP 2: pick date -->
    <div class="stp" data-step="2">
      <h2 style="font-size:20px; font-weight:600; margin:0 0 4px;"><?= t('book.step2.title') ?></h2>
      <p style="font-size:14px; color:rgba(0,0,0,0.5); margin:0 0 16px;"><?= t('book.step2.subtitle') ?></p>
      <input type="date" class="inp" id="booklyDate" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" min="<?= date('Y-m-d') ?>">
      <div style="display:flex; justify-content:space-between; margin-top:24px;">
        <button type="button" class="btn-back" data-go="1"><?= t('book.back') ?></button>
        <button type="button" class="btn-next" id="goStep3"><?= t('book.next') ?></button>
      </div>
    </div>

    <!-- STEP 3: pick time -->
    <div class="stp" data-step="3">
      <h2 style="font-size:20px; font-weight:600; margin:0 0 4px;"><?= t('book.step3.title') ?></h2>
      <p style="font-size:14px; color:rgba(0,0,0,0.5); margin:0 0 16px;"><?= t('book.step3.subtitle', ['date' => '']) ?><span id="booklyDateLabel"></span>.</p>
      <div id="booklyLoading" style="color:rgba(0,0,0,0.5); font-size:14px;"><?= t('book.step3.loading') ?></div>
      <div id="booklySlots" style="display:none; display:grid; grid-template-columns:repeat(3,1fr); gap:8px;"></div>
      <div style="display:flex; justify-content:space-between; margin-top:24px;">
        <button type="button" class="btn-back" data-go="2"><?= t('book.back') ?></button>
      </div>
    </div>

    <!-- STEP 4: details -->
    <div class="stp" data-step="4">
      <h2 style="font-size:20px; font-weight:600; margin:0 0 4px;"><?= t('book.step4.title') ?></h2>
      <p style="font-size:14px; color:rgba(0,0,0,0.5); margin:0 0 16px;"><?= t('book.step4.subtitle') ?></p>
      <form method="POST" action="/book/<?= e($business['slug']) ?>" id="booklyForm">
        <?= csrf_field() ?>
        <input type="hidden" name="service_id" id="booklyServiceId">
        <input type="hidden" name="date" id="booklyFormDate">
        <input type="hidden" name="time" id="booklyFormTime">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
          <div><label class="lbl"><?= t('book.firstname') ?></label><input class="inp" name="first_name" required></div>
          <div><label class="lbl"><?= t('book.lastname') ?></label><input class="inp" name="last_name" required></div>
        </div>
        <div style="margin-top:12px;"><label class="lbl"><?= t('book.email') ?></label><input class="inp" name="email" type="email" required></div>
        <div style="margin-top:12px;"><label class="lbl"><?= t('book.phone') ?></label><input class="inp" name="phone"></div>
        <div style="margin-top:12px;"><label class="lbl"><?= t('book.notes') ?></label><textarea class="inp" name="notes" rows="2"></textarea></div>
        <div style="display:flex; justify-content:space-between; margin-top:16px;">
          <button type="button" class="btn-back" data-go="3"><?= t('book.back') ?></button>
          <button type="submit" class="btn-next"><?= t('book.confirm') ?></button>
        </div>
      </form>
    </div>

  </div>

  <div style="text-align:center; font-size:12px; color:rgba(0,0,0,0.4); margin-top:32px;">
    <?= t('book.powered') ?> <a href="/" style="color:#0071E3; text-decoration:none;">Bookly</a>
  </div>
</div>

<script>
(function() {
  var root = document.getElementById('booklyDemo');
  if (!root) return;
  var step = 1;
  var state = { service: null, serviceName: '', date: root.querySelector('#booklyDate').value, time: null };
  var biz = <?= json_encode($business['slug']) ?>;

  function go(n) {
    if (n < 1 || n > 4) return;
    step = n;
    var steps = root.querySelectorAll('.stp');
    for (var i = 0; i < steps.length; i++) {
      if (parseInt(steps[i].getAttribute('data-step'), 10) === n) steps[i].classList.add('active');
      else steps[i].classList.remove('active');
    }
    var dots = root.querySelectorAll('[data-dot]');
    for (var j = 0; j < dots.length; j++) {
      var d = parseInt(dots[j].getAttribute('data-dot'), 10);
      dots[j].classList.remove('active', 'done', 'current');
      if (d < n) dots[j].classList.add('done');
      else if (d === n) { dots[j].classList.add('active', 'current'); }
      dots[j].textContent = d < n ? '✓' : String(d);
    }
    var lbls = root.querySelectorAll('[data-lbl]');
    for (var k = 0; k < lbls.length; k++) {
      var ld = parseInt(lbls[k].getAttribute('data-lbl'), 10);
      lbls[k].style.color = ld <= n ? '#1D1D1F' : 'rgba(0,0,0,0.4)';
    }
    var bar = root.querySelector('#booklyBar');
    if (bar) bar.style.width = (n * 25) + '%';
    if (n === 3) loadSlots();
  }

  function loadSlots() {
    var loading = root.querySelector('#booklyLoading');
    var slots = root.querySelector('#booklySlots');
    var dateLabel = root.querySelector('#booklyDateLabel');
    if (dateLabel) dateLabel.textContent = state.date;
    loading.style.display = 'block';
    slots.style.display = 'none';
    slots.innerHTML = '';
    fetch('/api/slots/' + encodeURIComponent(biz) + '/' + state.service + '/' + state.date)
      .then(function(r) { return r.json(); })
      .then(function(data) {
        loading.style.display = 'none';
        slots.style.display = 'grid';
        if (!data || data.length === 0) {
          slots.innerHTML = '<div style="grid-column:1/-1; color:rgba(0,0,0,0.5); font-size:14px;">No slots</div>';
          return;
        }
        for (var i = 0; i < data.length; i++) {
          (function(t) {
            var b = document.createElement('button');
            b.type = 'button';
            b.className = 'slot-btn';
            b.textContent = t;
            b.addEventListener('click', function() {
              state.time = t;
              var all = slots.querySelectorAll('.slot-btn');
              for (var j = 0; j < all.length; j++) all[j].classList.remove('selected');
              b.classList.add('selected');
              setTimeout(function() { go(4); syncForm(); }, 200);
            });
            slots.appendChild(b);
          })(data[i]);
        }
      })
      .catch(function(e) {
        loading.style.display = 'none';
        slots.style.display = 'grid';
        slots.innerHTML = '<div style="grid-column:1/-1; color:#FF3B30; font-size:14px;">Error loading slots</div>';
      });
  }

  function syncForm() {
    var sid = root.querySelector('#booklyServiceId');
    var fd = root.querySelector('#booklyFormDate');
    var ft = root.querySelector('#booklyFormTime');
    if (sid) sid.value = state.service || '';
    if (fd) fd.value = state.date || '';
    if (ft) ft.value = state.time || '';
  }

  // Service buttons
  var svcs = root.querySelectorAll('.svc-btn');
  for (var i = 0; i < svcs.length; i++) {
    svcs[i].addEventListener('click', function() {
      var id = parseInt(this.getAttribute('data-svc'), 10);
      state.service = id;
      state.serviceName = this.getAttribute('data-name') || '';
      for (var j = 0; j < svcs.length; j++) svcs[j].classList.remove('selected');
      this.classList.add('selected');
      var go2 = root.querySelector('#goStep2');
      if (go2) go2.disabled = false;
    });
  }

  // Step 2 → 3 button
  var go3 = root.querySelector('#goStep3');
  if (go3) go3.addEventListener('click', function() { state.date = root.querySelector('#booklyDate').value; go(3); });

  // Step 1 → 2 button
  var go2 = root.querySelector('#goStep2');
  if (go2) go2.addEventListener('click', function() { if (state.service) go(2); });

  // Back buttons
  var backs = root.querySelectorAll('.btn-back');
  for (var k = 0; k < backs.length; k++) {
    backs[k].addEventListener('click', function() {
      var t = parseInt(this.getAttribute('data-go'), 10);
      if (t) go(t);
    });
  }

  // Submit
  var form = root.querySelector('#booklyForm');
  if (form) form.addEventListener('submit', function() { syncForm(); });

  // Date change
  var dateInput = root.querySelector('#booklyDate');
  if (dateInput) dateInput.addEventListener('change', function() { state.date = this.value; });

  // Initial
  go(1);
})();
</script>
