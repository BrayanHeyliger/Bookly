<div class="max-w-2xl mx-auto" x-data="{ step: 1, service: null, date: '<?= date('Y-m-d', strtotime('+1 day')) ?>', time: null, slots: [], loading: false, biz: <?= json_encode($business['slug']) ?>, svc: null }">
<div class="text-center mb-6">
<div class="flex items-center justify-end mb-4">
<?= \Bookly\Support\LanguageSwitcher::render() ?>
</div>
<div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-[#0071E3] to-[#5AC8FA] text-white text-3xl font-bold mb-4">B</div>
<h1 class="text-3xl font-semibold tracking-tight"><?= e($business['name']) ?></h1>
<p class="text-black/50 mt-1"><?= e($business['description'] ?? '') ?></p>
</div>
<div class="h-1 bg-black/5 rounded-full overflow-hidden mb-6">
<div class="h-full bg-gradient-to-r from-[#0071E3] to-[#5AC8FA] transition-all duration-500" :style="`width: ${(step/4)*100}%`"></div>
</div>
<div class="apple-card p-8">
<div x-show="step === 1" x-transition>
<h2 class="text-xl font-semibold mb-1"><?= t('book.step1.title') ?></h2>
<p class="text-sm text-black/50 mb-4"><?= t('book.step1.subtitle') ?></p>
<div class="space-y-2">
<?php foreach ($services as $s): ?>
<button type="button" @click="service = <?= $s['id'] ?>; svc = <?= $s['id'] ?>; step = 2"
class="w-full text-left p-4 rounded-2xl border border-black/10 hover:border-[#0071E3] hover:bg-[#E8F3FF] transition">
<div class="flex items-center justify-between">
<div><div class="font-medium"><?= e($s['name']) ?></div><div class="text-sm text-black/50"><?= $s['duration'] ?> <?= t('common.min') ?></div></div>
<div class="font-semibold">$<?= number_format($s['price'], 2) ?></div>
</div>
</button>
<?php endforeach; ?>
</div>
</div>
<div x-show="step === 2" x-transition>
<h2 class="text-xl font-semibold mb-1"><?= t('book.step2.title') ?></h2>
<p class="text-sm text-black/50 mb-4"><?= t('book.step2.subtitle') ?></p>
<input class="input" type="date" x-model="date" :min="'<?= date('Y-m-d') ?>'">
<div class="flex gap-2 mt-6">
<button @click="step = 1" class="text-sm text-black/50"><?= t('book.back') ?></button>
<button @click="step = 3; loading = true; fetch('/api/slots/' + biz + '/' + service + '/' + date).then(r => r.json()).then(d => { slots = d; loading = false; })" class="btn-primary ml-auto"><?= t('book.next') ?></button>
</div>
</div>
<div x-show="step === 3" x-transition>
<h2 class="text-xl font-semibold mb-1"><?= t('book.step3.title') ?></h2>
<p class="text-sm text-black/50 mb-4"><?= t('book.step3.subtitle', ['date' => '']) ?><span x-text="date"></span>.</p>
<template x-if="loading"><div class="text-black/50 text-sm"><?= t('book.step3.loading') ?></div></template>
<div class="grid grid-cols-3 gap-2" x-show="!loading">
<template x-for="t in slots" :key="t">
<button @click="time = t; step = 4" class="p-3 rounded-xl border border-black/10 hover:border-[#0071E3] hover:bg-[#E8F3FF] font-medium" x-text="t"></button>
</template>
</div>
<div class="flex gap-2 mt-6">
<button @click="step = 2" class="text-sm text-black/50"><?= t('book.back') ?></button>
</div>
</div>
<div x-show="step === 4" x-transition>
<h2 class="text-xl font-semibold mb-1"><?= t('book.step4.title') ?></h2>
<p class="text-sm text-black/50 mb-4"><?= t('book.step4.subtitle') ?></p>
<form method="POST" action="/book/<?= e($business['slug']) ?>" class="space-y-3">
<?= csrf_field() ?>
<input type="hidden" name="service_id" :value="service">
<input type="hidden" name="date" :value="date">
<input type="hidden" name="time" :value="time">
<div class="grid grid-cols-2 gap-3">
<div><label class="label"><?= t('book.firstname') ?></label><input class="input" name="first_name" required></div>
<div><label class="label"><?= t('book.lastname') ?></label><input class="input" name="last_name" required></div>
</div>
<div><label class="label"><?= t('book.email') ?></label><input class="input" name="email" type="email" required></div>
<div><label class="label"><?= t('book.phone') ?></label><input class="input" name="phone"></div>
<div><label class="label"><?= t('book.notes') ?></label><textarea class="input" name="notes" rows="2"></textarea></div>
<div class="flex gap-2 pt-2">
<button type="button" @click="step = 3" class="text-sm text-black/50"><?= t('book.back') ?></button>
<button type="submit" class="btn-primary ml-auto"><?= t('book.confirm') ?></button>
</div>
</form>
</div>
</div>
<div class="text-center text-xs text-black/40 mt-8"><?= t('book.powered') ?> <a href="/" class="text-[#0071E3]">Bookly</a></div>
</div>
