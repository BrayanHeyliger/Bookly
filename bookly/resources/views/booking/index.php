<div class="max-w-2xl mx-auto" x-data="bookingFlow('<?= e($business['slug']) ?>')">

  <div class="text-center mb-8">
    <div class="w-16 h-16 mx-auto rounded-3xl gradient-bg grid place-items-center text-white text-2xl font-bold mb-4"><?= e(mb_substr($business['name'], 0, 1)) ?></div>
    <h1 class="text-3xl font-semibold tracking-tight"><?= e($business['name']) ?></h1>
    <?php if (! empty($business['description'])): ?>
      <p class="text-black/60 mt-2"><?= e($business['description']) ?></p>
    <?php endif; ?>
    <?php if (! empty($business['city']) || ! empty($business['address'])): ?>
      <p class="text-sm text-black/40 mt-2"><?= e(trim(($business['address'] ?? '').', '.($business['city'] ?? ''), ', ')) ?></p>
    <?php endif; ?>
  </div>

  <div class="flex items-center justify-center gap-2 mb-6">
    <template x-for="s in [1,2,3,4]" :key="s">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-full grid place-items-center text-xs font-semibold transition"
             :class="step >= s ? 'bg-[#0071E3] text-white' : 'bg-black/5 text-black/40'" x-text="s"></div>
        <div class="w-6 h-px" :class="step > s ? 'bg-[#0071E3]' : 'bg-black/10'"></div>
      </div>
    </template>
  </div>

  <div class="apple-card p-8">

    <div x-show="step === 1" x-transition>
      <div class="text-lg font-semibold mb-4">Choose a service</div>
      <div class="space-y-3">
        <?php if (empty($services)): ?>
          <p class="text-sm text-black/50">This business has not published any services yet.</p>
        <?php endif; ?>
        <?php foreach ($services as $s): ?>
          <button type="button"
                  class="w-full text-left p-4 rounded-2xl border transition hover:border-[#0071E3]"
                  :class="serviceId === <?= (int)$s['id'] ?> ? 'border-[#0071E3] bg-[#E8F3FF]' : 'border-black/10'"
                  @click="pickService(<?= (int)$s['id'] ?>, $event)">
            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium service-name"><?= e($s['name']) ?></div>
                <div class="text-sm text-black/50"><?= (int)$s['duration'] ?> min<?= ! empty($s['category']) ? ' - '.e($s['category']) : '' ?></div>
              </div>
              <div class="font-semibold"><?= number_format($s['price'], 0) ?></div>
            </div>
          </button>
        <?php endforeach; ?>
      </div>
    </div>

    <div x-show="step === 2" x-transition>
      <div class="text-lg font-semibold mb-4">Pick a date</div>
      <input type="date" class="input" x-model="date" :min="today" @change="loadSlots()">
      <p class="text-xs text-black/40 mt-2">Availability comes from the business opening hours.</p>
    </div>

    <div x-show="step === 3" x-transition>
      <div class="text-lg font-semibold mb-4">Choose a time</div>
      <div x-show="loading" class="text-sm text-black/50 py-8 text-center">Loading availability...</div>
      <div x-show="!loading && slots.length === 0" class="text-sm text-black/50 py-8 text-center">
        No slots left on this day. Try another date.
      </div>
      <div class="grid grid-cols-3 sm:grid-cols-4 gap-2" x-show="!loading && slots.length > 0">
        <template x-for="t in slots" :key="t">
          <button type="button" class="py-2.5 rounded-xl border text-sm transition"
                  :class="time === t ? 'border-[#0071E3] bg-[#E8F3FF] text-[#0071E3] font-medium' : 'border-black/10 hover:border-black/20'"
                  @click="time = t" x-text="t"></button>
        </template>
      </div>
    </div>

    <div x-show="step === 4" x-transition>
      <div class="text-lg font-semibold mb-4">Your details</div>
      <form method="POST" action="/book/<?= e($business['slug']) ?>" class="space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="service_id" :value="serviceId">
        <input type="hidden" name="date" :value="date">
        <input type="hidden" name="time" :value="time">
        <div class="grid sm:grid-cols-2 gap-4">
          <div><label class="label">First name</label><input class="input" name="first_name" required></div>
          <div><label class="label">Last name</label><input class="input" name="last_name"></div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div><label class="label">Email</label><input class="input" name="email" type="email" required></div>
          <div><label class="label">Phone</label><input class="input" name="phone" type="tel"></div>
        </div>
        <div><label class="label">Notes</label><textarea class="input" name="notes" rows="2" placeholder="Anything we should know?"></textarea></div>
        <div class="p-4 rounded-2xl bg-[#F5F5F7] text-sm">
          <div class="flex justify-between"><span class="text-black/50">Service</span><span x-text="serviceName || '-' "></span></div>
          <div class="flex justify-between mt-1"><span class="text-black/50">When</span><span x-text="date && time ? date + ' - ' + time : '-' "></span></div>
        </div>
        <button type="submit" class="btn-primary w-full justify-center">Confirm booking</button>
      </form>
    </div>

    <div class="flex items-center justify-between mt-6 pt-6 border-t border-black/5">
      <button type="button" class="btn-ghost text-sm" x-show="step > 1" @click="step--">Back</button>
      <div class="ml-auto">
        <button type="button" class="btn-primary text-sm" x-show="step < 4" :disabled="!canAdvance" @click="step++" :class="!canAdvance && 'opacity-40 cursor-not-allowed'">Continue</button>
      </div>
    </div>
  </div>

  <p class="text-center text-xs text-black/40 mt-6">Powered by Bookly</p>
</div>

<script>
function bookingFlow(slug) {
  return {
    step: 1,
    serviceId: null,
    serviceName: '',
    date: '',
    time: '',
    slots: [],
    loading: false,
    today: new Date().toISOString().slice(0, 10),
    pickService(id, ev) {
      this.serviceId = id;
      const el = ev.currentTarget.querySelector('.service-name');
      this.serviceName = el ? el.textContent.trim() : '';
      this.time = '';
      this.slots = [];
    },
    get canAdvance() {
      if (this.step === 1) return this.serviceId !== null;
      if (this.step === 2) return this.date !== '';
      if (this.step === 3) return this.time !== '';
      return false;
    },
    async loadSlots() {
      if (!this.date || !this.serviceId) return;
      this.loading = true;
      this.slots = [];
      this.time = '';
      try {
        const res = await fetch('/api/slots/' + slug + '/' + this.serviceId + '/' + this.date);
        this.slots = await res.json();
      } catch (e) {
        this.slots = [];
      }
      this.loading = false;
    }
  };
}
</script>
