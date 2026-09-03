<?php
$__data = $__data ?? get_defined_vars();
$__use_data = $__data;
$__view = 'marketing.landing';
?><!DOCTYPE html>
<html lang="<?= e(\Bookly\Support\Language::current()) ?>" dir="<?= e(\Bookly\Support\Language::dir()) ?>" class="bg-white">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bookly — The booking platform built for service businesses</title>
<meta name="description" content="Bookly is the all-in-one booking platform for barber shops, salons, spas and tattoo studios. Beautiful Apple-style design, modular addons, ready in 5 minutes.">
<script src="https://cdn.tailwindcss.com"></script>
<style>
body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.gradient-text { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
.gradient-bg { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); }
.glass { background: rgba(255,255,255,0.72); backdrop-filter: saturate(180%) blur(20px); -webkit-backdrop-filter: saturate(180%) blur(20px); }
.apple-card { background: #fff; border-radius: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 4px 24px rgba(0,0,0,0.05); transition: all .3s; }
.apple-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,0,0,0.08); }
.btn-primary { background: #0071E3; color: #fff; padding: 12px 24px; border-radius: 999px; font-weight: 500; transition: all .25s; display:inline-flex; align-items:center; gap:.5rem; cursor: pointer; border: none; text-decoration: none; font-size: 0.9375rem; }
.btn-primary:hover { background: #0066CC; transform: translateY(-1px); }
.btn-ghost { padding: 12px 24px; border-radius: 999px; font-weight: 500; color: #1D1D1F; transition: all .25s; cursor: pointer; background: transparent; border: none; font-size: 0.9375rem; text-decoration: none; }
.btn-ghost:hover { background: rgba(0,0,0,0.05); }
.btn-link { color: #0071E3; font-weight: 500; text-decoration: none; }
.btn-link:hover { text-decoration: underline; }
.fade-in { animation: fadeIn .8s ease both; }
.slide-up { animation: slideUp .8s cubic-bezier(.16,1,.3,1) both; }
@keyframes fadeIn { from {opacity: 0} to {opacity: 1} }
@keyframes slideUp { from {opacity:0; transform: translateY(20px)} to {opacity:1; transform: translateY(0)} }
.hero-bg { background: linear-gradient(180deg, #F5F5F7 0%, #FFFFFF 100%); }
.glow { position: absolute; width: 600px; height: 600px; border-radius: 50%; filter: blur(120px); opacity: 0.3; pointer-events: none; }
.section { padding: 96px 24px; }
@media (max-width: 768px) { .section { padding: 64px 20px; } .hero-title { font-size: 2.5rem !important; line-height: 1.1 !important; } }
.gradient-hero-text { font-size: 4.5rem; line-height: 1.05; font-weight: 700; letter-spacing: -0.04em; }
@media (max-width: 768px) { .gradient-hero-text { font-size: 2.75rem !important; } }
.feature-icon { width: 56px; height: 56px; border-radius: 16px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; color: white; }
.pill { display:inline-flex; align-items:center; gap:.375rem; padding:6px 14px; border-radius:999px; font-size:.8125rem; font-weight:500; }
.divider { height: 1px; background: linear-gradient(90deg, transparent, rgba(0,0,0,0.1), transparent); }
</style>
</head>
<body class="antialiased">

<!-- Navigation -->
<nav class="glass fixed top-0 left-0 right-0 z-50 border-b border-black/5">
<div class="max-w-6xl mx-auto px-6 h-14 flex items-center justify-between">
<a href="/" class="flex items-center gap-2 text-decoration-none">
<div class="w-8 h-8 rounded-xl gradient-bg grid place-items-center text-white font-bold text-sm">B</div>
<span class="text-base font-semibold tracking-tight text-[#1D1D1F]">Bookly</span>
</a>
<div class="hidden md:flex items-center gap-7 text-sm font-medium text-[#1D1D1F]">
<a href="#memberships" class="hover:text-[#0071E3] transition flex items-center gap-1.5"><?= t('nav.memberships') ?> <span class="pill bg-[#FF9500] text-white text-[10px] py-0.5 px-1.5">New</span></a>
<a href="#features" class="hover:text-[#0071E3] transition"><?= t('nav.features') ?></a>
<a href="#addons" class="hover:text-[#0071E3] transition"><?= t('nav.addons') ?></a>
<a href="#pricing" class="hover:text-[#0071E3] transition"><?= t('nav.pricing') ?></a>
<a href="/blog" class="hover:text-[#0071E3] transition">Blog</a>
<a href="/book/studio-demo" class="hover:text-[#0071E3] transition"><?= t('nav.demo') ?></a>
</div>
<div class="flex items-center gap-2">
<?= \Bookly\Support\LanguageSwitcher::render() ?>
<a href="/login" class="btn-ghost text-sm"><?= t('nav.signin') ?></a>
<a href="/install" class="btn-primary text-sm"><?= t('nav.getstarted') ?></a>
</div>
</div>
</nav>

<!-- Hero -->
<header class="hero-bg relative overflow-hidden pt-32 pb-24 px-6">
<div class="glow gradient-bg" style="top: -200px; left: -200px;"></div>
<div class="glow" style="bottom: -200px; right: -200px; background: #AF52DE;"></div>
<div class="max-w-5xl mx-auto text-center relative">
<div class="pill bg-white/60 backdrop-blur border border-black/5 text-[#0071E3] mb-6 slide-up">
<span>💎</span> <?= t('hero.pill') ?>
</div>
<h1 class="gradient-hero-text slide-up text-[#1D1D1F]" style="animation-delay: .1s">
<?= t('hero.title.1') ?><br>
<span class="gradient-text"><?= t('hero.title.2') ?></span>
</h1>
<p class="text-xl md:text-2xl text-black/60 mt-6 max-w-2xl mx-auto slide-up" style="animation-delay: .2s">
<?= t('hero.subtitle') ?>
</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-10 slide-up" style="animation-delay: .3s">
<a href="/install" class="btn-primary text-base px-7 py-3.5"><?= t('hero.cta.primary') ?></a>
<a href="/book/studio-demo" class="btn-ghost text-base px-7 py-3.5"><?= t('hero.cta.secondary') ?></a>
</div>
<p class="text-sm text-black/40 mt-4"><?= t('hero.fineprint') ?></p>

<!-- Hero preview / mockup -->
<div class="mt-16 max-w-4xl mx-auto slide-up" style="animation-delay: .4s">
<div class="apple-card p-4 md:p-6 relative">
<div class="flex items-center gap-1.5 mb-4">
<div class="w-3 h-3 rounded-full bg-[#FF5F57]"></div>
<div class="w-3 h-3 rounded-full bg-[#FEBC2E]"></div>
<div class="w-3 h-3 rounded-full bg-[#28C840]"></div>
<div class="ml-3 text-xs text-black/40">bookly.app/dashboard</div>
</div>
<div class="grid grid-cols-3 gap-3">
<div class="col-span-2 p-4 rounded-2xl bg-gradient-to-br from-[#E8F3FF] to-white">
<div class="text-xs text-black/50 mb-2"><?= t('hero.mockup.week') ?></div>
<div class="flex items-end gap-1 h-24">
<?php for ($i = 0; $i < 14; $i++): $h = 20 + sin($i) * 30 + rand(0, 30); ?>
<div class="flex-1 rounded-t gradient-bg" style="height: <?= max(20, $h) ?>%; opacity: <?= 0.5 + $i/30 ?>"></div>
<?php endfor; ?>
</div>
</div>
<div class="p-4 rounded-2xl bg-[#F5F5F7] space-y-2">
<div class="text-xs text-black/50"><?= t('hero.mockup.today') ?></div>
<div class="space-y-1.5">
<div class="p-2 rounded-lg bg-white text-xs"><div class="font-medium"><?= t('hero.mockup.svc1') ?></div><div class="text-black/50">10:00 · Alex</div></div>
<div class="p-2 rounded-lg bg-white text-xs"><div class="font-medium"><?= t('hero.mockup.svc2') ?></div><div class="text-black/50">11:30 · Jamie</div></div>
<div class="p-2 rounded-lg bg-white text-xs"><div class="font-medium"><?= t('hero.mockup.svc3') ?></div><div class="text-black/50">14:00 · Rita</div></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</header>

<!-- Logos / Social proof -->
<section class="py-12 px-6 border-y border-black/5 bg-[#F5F5F7]/50">
<div class="max-w-6xl mx-auto">
</div>
</section>

<!-- How it works -->
<section class="section">
<div class="max-w-5xl mx-auto">
<div class="text-center mb-14">
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4"><span>🚀</span> How it works</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight">Book in 3 steps.</h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto">No phone calls. No back-and-forth. Just pick, book, show up.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
<div class="apple-card p-8 text-center">
<div class="w-14 h-14 rounded-full gradient-bg grid place-items-center text-white text-2xl font-bold mx-auto">1</div>
<div class="text-xl font-semibold mt-5">Search</div>
<p class="text-sm text-black/60 mt-2">Find the perfect professional by service, category or city. Filter by rating, price and availability.</p>
</div>
<div class="apple-card p-8 text-center">
<div class="w-14 h-14 rounded-full gradient-bg grid place-items-center text-white text-2xl font-bold mx-auto">2</div>
<div class="text-xl font-semibold mt-5">Book</div>
<p class="text-sm text-black/60 mt-2">Pick a service, choose a time and confirm. Get instant email and SMS confirmation. Free to book.</p>
</div>
<div class="apple-card p-8 text-center">
<div class="w-14 h-14 rounded-full gradient-bg grid place-items-center text-white text-2xl font-bold mx-auto">3</div>
<div class="text-xl font-semibold mt-5">Show up</div>
<p class="text-sm text-black/60 mt-2">Arrive and get served. Pay in-app or in person. Leave a review and earn loyalty points.</p>
</div>
</div>
</div>
</section>

<!-- Memberships (the hero feature for selling) -->
<section id="memberships" class="section" style="background: linear-gradient(180deg, #FFFFFF 0%, #F5F5F7 100%);">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-14">
<div class="pill bg-gradient-to-r from-[#FF9500] to-[#FF2D55] text-white mb-4"><span>💎</span> <?= t('memb.pill') ?></div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight text-[#1D1D1F]"><?= t('memb.title') ?></h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto"><?= t('memb.subtitle') ?></p>
</div>

<!-- Membership tiers mockup -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-16">
<div class="apple-card p-7">
<div class="flex items-center justify-between">
<div class="text-xs font-semibold uppercase tracking-wider text-black/50"><?= t('memb.tier.bronze') ?></div>
<div class="pill bg-[#CD7F32]/10 text-[#CD7F32] text-[10px]">$39 <?= t('memb.per.month') ?></div>
</div>
<div class="text-2xl font-semibold mt-3"><?= t('memb.tier.bronze.name') ?></div>
<p class="text-sm text-black/60 mt-2"><?= t('memb.tier.bronze.desc') ?></p>
<div class="divider my-5"></div>
<ul class="space-y-2.5 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 2 services per month</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 10% off all add-ons</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Priority booking</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Cancel anytime</li>
</ul>
</div>
<div class="apple-card p-7 relative" style="border: 2px solid #FF9500; transform: scale(1.03);">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 pill gradient-bg text-white text-xs" style="background: linear-gradient(135deg, #FF9500, #FF2D55);"><?= t('memb.bestseller') ?></div>
<div class="flex items-center justify-between">
<div class="text-xs font-semibold uppercase tracking-wider text-[#FF9500]"><?= t('memb.tier.gold') ?></div>
<div class="pill bg-[#FF9500]/10 text-[#FF9500] text-[10px]">$89 <?= t('memb.per.month') ?></div>
</div>
<div class="text-2xl font-semibold mt-3"><?= t('memb.tier.gold.name') ?></div>
<p class="text-sm text-black/60 mt-2"><?= t('memb.tier.gold.desc') ?></p>
<div class="divider my-5"></div>
<ul class="space-y-2.5 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 1 included service per week</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 20% off all add-ons</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Member-only hours</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Birthday gift</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Free product samples</li>
</ul>
</div>
<div class="apple-card p-7">
<div class="flex items-center justify-between">
<div class="text-xs font-semibold uppercase tracking-wider text-black/50"><?= t('memb.tier.platinum') ?></div>
<div class="pill bg-[#5AC8FA]/10 text-[#0071E3] text-[10px]">$189 <?= t('memb.per.month') ?></div>
</div>
<div class="text-2xl font-semibold mt-3"><?= t('memb.tier.platinum.name') ?></div>
<p class="text-sm text-black/60 mt-2"><?= t('memb.tier.platinum.desc') ?></p>
<div class="divider my-5"></div>
<ul class="space-y-2.5 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Unlimited services</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 30% off all add-ons</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Free products monthly</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> VIP events & invites</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Concierge booking</li>
</ul>
</div>
</div>

<!-- ROI stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-14">
<div class="apple-card p-6 text-center">
<div class="text-3xl md:text-4xl font-semibold gradient-text">+38%</div>
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider"><?= t('memb.stat.revenue') ?></div>
</div>
<div class="apple-card p-6 text-center">
<div class="text-3xl md:text-4xl font-semibold gradient-text">12 min</div>
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider"><?= t('memb.stat.setup') ?></div>
</div>
<div class="apple-card p-6 text-center">
<div class="text-3xl md:text-4xl font-semibold gradient-text">−47%</div>
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider"><?= t('memb.stat.noshow') ?></div>
</div>
<div class="apple-card p-6 text-center">
<div class="text-3xl md:text-4xl font-semibold gradient-text">14 mo</div>
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider"><?= t('memb.stat.lifetime') ?></div>
</div>
</div>

<!-- 3-step how it works -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
<div class="apple-card p-7 text-center">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold mx-auto">1</div>
<div class="text-lg font-semibold mt-4"><?= t('memb.step1.title') ?></div>
<p class="text-sm text-black/60 mt-2"><?= t('memb.step1.desc') ?></p>
</div>
<div class="apple-card p-7 text-center">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold mx-auto">2</div>
<div class="text-lg font-semibold mt-4"><?= t('memb.step2.title') ?></div>
<p class="text-sm text-black/60 mt-2"><?= t('memb.step2.desc') ?></p>
</div>
<div class="apple-card p-7 text-center">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold mx-auto">3</div>
<div class="text-lg font-semibold mt-4"><?= t('memb.step3.title') ?></div>
<p class="text-sm text-black/60 mt-2"><?= t('memb.step3.desc') ?></p>
</div>
</div>
<div class="text-center mt-10">
<a href="/install" class="btn-primary text-base px-7 py-3.5"><?= t('memb.cta') ?></a>
<p class="text-xs text-black/40 mt-3"><?= t('memb.cta.fineprint') ?></p>
</div>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Testimonials for memberships -->
<section class="section bg-[#F5F5F7]">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-14">
<div class="pill bg-white text-[#0071E3] mb-4"><span>💬</span> <?= t('test.pill') ?></div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight"><?= t('test.title') ?></h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto"><?= t('test.subtitle') ?></p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
<div class="apple-card p-7">
<div class="flex items-center gap-1 text-[#FF9500] text-sm">★★★★★</div>
<p class="text-base text-[#1D1D1F] mt-4 leading-relaxed"><?= t('test.q1', ['plan' => t('memb.tier.gold'), 'n' => '47', 'mrr' => '$4,183']) ?></p>
<div class="flex items-center gap-3 mt-6">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold">JR</div>
<div><div class="text-sm font-semibold"><?= t('test.q1.author') ?></div><div class="text-xs text-black/50"><?= t('test.q1.role') ?></div></div>
</div>
</div>
<div class="apple-card p-7">
<div class="flex items-center gap-1 text-[#FF9500] text-sm">★★★★★</div>
<p class="text-base text-[#1D1D1F] mt-4 leading-relaxed"><?= t('test.q2', ['plan' => t('memb.tier.platinum'), 'pct' => '62%']) ?></p>
<div class="flex items-center gap-3 mt-6">
<div class="w-10 h-10 rounded-full grid place-items-center text-white font-semibold" style="background: linear-gradient(135deg, #FF9500, #FF2D55);">SM</div>
<div><div class="text-sm font-semibold"><?= t('test.q2.author') ?></div><div class="text-xs text-black/50"><?= t('test.q2.role') ?></div></div>
</div>
</div>
<div class="apple-card p-7">
<div class="flex items-center gap-1 text-[#FF9500] text-sm">★★★★★</div>
<p class="text-base text-[#1D1D1F] mt-4 leading-relaxed"><?= t('test.q3', ['save' => '$240']) ?></p>
<div class="flex items-center gap-3 mt-6">
<div class="w-10 h-10 rounded-full grid place-items-center text-white font-semibold" style="background: linear-gradient(135deg, #34C759, #5AC8FA);">AT</div>
<div><div class="text-sm font-semibold"><?= t('test.q3.author') ?></div><div class="text-xs text-black/50"><?= t('test.q3.role') ?></div></div>
</div>
</div>
</div>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Bookly vs Booksy comparison -->
<section class="section">
<div class="max-w-5xl mx-auto">
<div class="text-center mb-12">
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4"><span>⚖️</span> <?= t('vs.pill') ?></div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight"><?= t('vs.title') ?></h2>
<p class="text-xl text-black/60 mt-4"><?= t('vs.subtitle') ?></p>
</div>
<div class="apple-card overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-[#F5F5F7] text-left">
<tr><th class="p-4 font-semibold"><?= t('vs.th.feature') ?></th><th class="p-4 text-center font-semibold text-[#0071E3]"><?= t('vs.th.bookly') ?></th><th class="p-4 text-center font-semibold text-black/50"><?= t('vs.th.booksy') ?></th></tr>
</thead>
<tbody class="divide-y divide-black/5">
<tr><td class="p-4"><?= t('vs.row1') ?></td><td class="p-4 text-center font-semibold text-[#34C759]">$29</td><td class="p-4 text-center text-black/50">$45+</td></tr>
<tr><td class="p-4"><?= t('vs.row2') ?></td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-black/30">—</td></tr>
<tr><td class="p-4"><?= t('vs.row3') ?></td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-[#FF9500]"><?= t('vs.row3') === 'Unlimited members' ? 'Plan-limited' : '' ?></td></tr>
<tr><td class="p-4"><?= t('vs.row4') ?></td><td class="p-4 text-center text-[#34C759]"><?= t('vs.row4') === 'Membership dunning' ? 'Built-in' : '' ?></td><td class="p-4 text-center text-[#FF9500]">$20/mo</td></tr>
<tr><td class="p-4"><?= t('vs.row5') ?></td><td class="p-4 text-center text-[#34C759]"><?= t('vs.row5') === 'Public booking page' ? 'Free, unlimited' : '' ?></td><td class="p-4 text-center text-[#FF9500]">$25/mo</td></tr>
<tr><td class="p-4"><?= t('vs.row6') ?></td><td class="p-4 text-center text-[#34C759]"><?= t('vs.row6') === 'WhatsApp reminders' ? 'Included' : '' ?></td><td class="p-4 text-center text-[#FF9500]">$15/mo</td></tr>
<tr><td class="p-4"><?= t('vs.row7') ?></td><td class="p-4 text-center text-[#34C759]">12 min</td><td class="p-4 text-center text-black/50">2–3 hours</td></tr>
<tr><td class="p-4"><?= t('vs.row8') ?></td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-[#FF9500]">—</td></tr>
<tr><td class="p-4"><?= t('vs.row9') ?></td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-[#FF9500]">$99+</td></tr>
</tbody>
</table>
</div>
<p class="text-center text-sm text-black/50 mt-6"><?= t('vs.note', ['save' => '$192+']) ?></p>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Logos / Social proof -->
<section class="py-12 px-6 border-y border-black/5 bg-[#F5F5F7]/50">
<div class="max-w-6xl mx-auto">
<div class="text-center text-xs uppercase tracking-widest text-black/40 font-medium mb-6"><?= t('social.title') ?></div>
<div class="flex flex-wrap items-center justify-center gap-x-12 gap-y-4 text-2xl font-semibold text-black/30">
<span>Salon & Spa</span><span>✦</span>
<span>Barber Co.</span><span>✦</span>
<span>Studio Nine</span><span>✦</span>
<span>Beauty Bar</span><span>✦</span>
<span>Cut & Co.</span><span>✦</span>
<span>The Den</span>
</div>
</div>
</section>

<!-- Features -->
<section id="features" class="section">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-16">
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4"><span>⚡</span> <?= t('feat.pill') ?></div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight text-[#1D1D1F]"><?= t('feat.title') ?></h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto"><?= t('feat.subtitle') ?></p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
<?php
$features = [
    ['icon' => '📅', 'color' => 'gradient-bg', 'key' => '1'],
    ['icon' => '⚡️', 'color' => 'gradient-bg', 'key' => '2'],
    ['icon' => '💳', 'color' => 'gradient-bg', 'key' => '3'],
    ['icon' => '🔔', 'color' => 'gradient-bg', 'key' => '4'],
    ['icon' => '👥', 'color' => 'gradient-bg', 'key' => '5'],
    ['icon' => '📊', 'color' => 'gradient-bg', 'key' => '6'],
    ['icon' => '⭐', 'color' => 'gradient-bg', 'key' => '7'],
    ['icon' => '🌍', 'color' => 'gradient-bg', 'key' => '8'],
    ['icon' => '🎨', 'color' => 'gradient-bg', 'key' => '9'],
];
foreach ($features as $f): ?>
<div class="apple-card p-7">
<div class="feature-icon <?= e($f['color']) ?> mb-4"><?= $f['icon'] ?></div>
<div class="text-lg font-semibold text-[#1D1D1F]"><?= t('feat.'.$f['key'].'.title') ?></div>
<div class="text-sm text-black/60 mt-2"><?= t('feat.'.$f['key'].'.desc') ?></div>
</div>
<?php endforeach; ?>
</div>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Addons -->
<section id="addons" class="section bg-[#F5F5F7]">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-16">
<div class="pill bg-white text-[#0071E3] mb-4"><span>🧩</span> <?= t('addons.pill') ?></div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight"><?= t('addons.title') ?></h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto"><?= t('addons.subtitle') ?></p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
<?php
$addons = [
    ['icon' => '💬', 'name' => 'WhatsApp Bot', 'cat' => 'Messaging', 'color' => '#34C759'],
    ['icon' => '⭐', 'name' => 'Memberships', 'cat' => 'Revenue', 'color' => '#0071E3'],
    ['icon' => '🎁', 'name' => 'Loyalty', 'cat' => 'Retention', 'color' => '#FF9500'],
    ['icon' => '🎟️', 'name' => 'Gift Cards', 'cat' => 'Revenue', 'color' => '#AF52DE'],
    ['icon' => '🛒', 'name' => 'POS', 'cat' => 'Operations', 'color' => '#FF3B30'],
    ['icon' => '📦', 'name' => 'Inventory', 'cat' => 'Operations', 'color' => '#5AC8FA'],
    ['icon' => '🌐', 'name' => 'Multi-location', 'cat' => 'Scale', 'color' => '#0071E3'],
    ['icon' => '📹', 'name' => 'Video Calls', 'cat' => 'Engagement', 'color' => '#FF2D55'],
    ['icon' => '✨', 'name' => 'AI Assistant', 'cat' => 'AI', 'color' => '#FFCC00'],
    ['icon' => '📋', 'name' => 'Waitlist', 'cat' => 'Optimization', 'color' => '#34C759'],
];
foreach ($addons as $a): ?>
<div class="apple-card p-5 text-center">
<div class="w-12 h-12 mx-auto rounded-2xl grid place-items-center text-white text-xl mb-3" style="background: linear-gradient(135deg, <?= e($a['color']) ?>, #5AC8FA)"><?= $a['icon'] ?></div>
<div class="font-semibold text-sm text-[#1D1D1F]"><?= e($a['name']) ?></div>
<div class="text-xs text-black/50 mt-0.5"><?= e($a['cat']) ?></div>
</div>
<?php endforeach; ?>
</div>
<div class="text-center mt-10">
<a href="/addons" class="btn-link"><?= t('addons.link') ?></a>
</div>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Pricing -->
<section id="pricing" class="section">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-16">
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4"><span>💎</span> <?= t('price.pill') ?></div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight"><?= t('price.title') ?></h2>
<p class="text-xl text-black/60 mt-4"><?= t('price.subtitle') ?></p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-5xl mx-auto">
<!-- Starter -->
<div class="apple-card p-8">
<div class="text-sm font-medium text-black/50 uppercase tracking-wide"><?= t('price.starter.name') ?></div>
<div class="mt-3 flex items-baseline gap-1">
<span class="text-5xl font-semibold">$0</span>
<span class="text-black/50"><?= t('memb.per.month') ?></span>
</div>
<p class="text-sm text-black/60 mt-3"><?= t('price.starter.desc') ?></p>
<div class="divider my-6"></div>
<ul class="space-y-3 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 1 staff member</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 100 bookings / month</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Public booking page</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Email reminders</li>
<li class="flex gap-2 text-black/30"><span>—</span> SMS & WhatsApp addons</li>
</ul>
<a href="/install" class="btn-ghost w-full text-center mt-6 block"><?= t('price.cta.starter') ?></a>
</div>
<!-- Pro (highlighted) -->
<div class="apple-card p-8 relative" style="border: 2px solid #0071E3; transform: scale(1.02);">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 pill gradient-bg text-white text-xs"><?= t('price.pro.badge') ?></div>
<div class="text-sm font-medium text-[#0071E3] uppercase tracking-wide"><?= t('price.pro.name') ?></div>
<div class="mt-3 flex items-baseline gap-1">
<span class="text-5xl font-semibold">$29</span>
<span class="text-black/50"><?= t('memb.per.month') ?></span>
</div>
<p class="text-sm text-black/60 mt-3"><?= t('price.pro.desc') ?></p>
<div class="divider my-6"></div>
<ul class="space-y-3 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Up to 10 staff</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Unlimited bookings</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Stripe payments & deposits</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> SMS + email reminders</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Reviews & reports</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 3 addons included</li>
</ul>
<a href="/install" class="btn-primary w-full text-center mt-6 block"><?= t('price.cta.pro') ?></a>
</div>
<!-- Business -->
<div class="apple-card p-8">
<div class="text-sm font-medium text-black/50 uppercase tracking-wide"><?= t('price.biz.name') ?></div>
<div class="mt-3 flex items-baseline gap-1">
<span class="text-5xl font-semibold">$79</span>
<span class="text-black/50"><?= t('memb.per.month') ?></span>
</div>
<p class="text-sm text-black/60 mt-3"><?= t('price.biz.desc') ?></p>
<div class="divider my-6"></div>
<ul class="space-y-3 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Unlimited staff & locations</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Everything in Pro</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> All addons included</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> White-label booking page</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Priority support</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> API access</li>
</ul>
<a href="/install" class="btn-ghost w-full text-center mt-6 block"><?= t('price.cta.biz') ?></a>
</div>
</div>
<p class="text-center text-sm text-black/40 mt-8"><?= t('price.foot') ?></p>
</div>
</section>

<!-- App download promo -->
<section class="section bg-[#1D1D1F] text-white relative overflow-hidden">
<div class="glow" style="top: -100px; right: 10%; background: #0071E3; opacity: 0.2;"></div>
<div class="max-w-5xl mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
<div>
<div class="pill bg-white/10 text-white border border-white/20 mb-4">📱 Download the app</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight">Book on the go.</h2>
<p class="text-xl text-white/60 mt-4">Get Bookly for iOS and Android. Manage appointments, track loyalty and get reminders — all from your pocket.</p>
<div class="flex flex-col sm:flex-row gap-3 mt-8">
<a href="#" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-white text-[#1D1D1F] font-semibold hover:bg-gray-100 transition">
<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.56C4.46 16.27 2.94 11.65 4.7 8.26c1.26-2.44 3.47-3.95 5.86-3.98 1.76-.02 3.24 1.14 4.24 1.14 1 0 2.74-1.4 4.58-1.19.68.03 2.58.28 3.8 2.13-.09.06-2.17 1.28-2.15 3.8.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.4 2.76zM13 3.5c.73-.83 1.21-1.96 1.07-3.11-1.05.05-2.31.7-3.06 1.58-.68.79-1.26 2.05-1.1 3.16 1.19.09 2.36-.63 3.09-1.63z"/></svg>
<div><div class="text-[10px] leading-tight opacity-70">Download on the</div><div class="text-sm font-semibold leading-tight">App Store</div></div>
</a>
<a href="#" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-white text-[#1D1D1F] font-semibold hover:bg-gray-100 transition">
<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.199l2.302 2.302a1 1 0 010 1.414l-2.302 2.302-2.302-2.302a1 1 0 010-1.414zM15.5 12l-2.302 2.302L19.5 12l-4-2.302z"/></svg>
<div><div class="text-[10px] leading-tight opacity-70">Get it on</div><div class="text-sm font-semibold leading-tight">Google Play</div></div>
</a>
</div>
</div>
<div class="hidden lg:flex justify-center">
<div class="w-64 h-[500px] bg-white rounded-[40px] border-8 border-white shadow-2xl flex items-center justify-center text-6xl">📱</div>
</div>
</div>
</div>
</section>

<!-- Final CTA -->
<section class="section bg-[#1D1D1F] text-white relative overflow-hidden">
<div class="glow" style="top: -100px; left: 20%; background: #FF9500; opacity: 0.25;"></div>
<div class="glow" style="bottom: -100px; right: 20%; background: #0071E3; opacity: 0.25;"></div>
<div class="max-w-3xl mx-auto text-center relative">
<div class="pill bg-white/10 text-white border border-white/20 mb-6">💎 <?= t('final.pill') ?></div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight"><?= t('final.title') ?></h2>
<p class="text-xl text-white/60 mt-4"><?= t('final.subtitle') ?></p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
<a href="/install" class="btn-primary text-base px-7 py-3.5" style="background: #FF9500;"><?= t('hero.cta.primary') ?></a>
<a href="/book/studio-demo" class="text-white/80 hover:text-white px-7 py-3.5 text-base"><?= t('hero.cta.secondary') ?></a>
</div>
<p class="text-xs text-white/40 mt-6"><?= t('final.fineprint') ?></p>
</div>
</section>

<!-- Footer -->
<footer class="bg-[#F5F5F7] border-t border-black/5 py-12 px-6">
<div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
<div class="col-span-2 md:col-span-1">
<div class="flex items-center gap-2 mb-3">
<div class="w-8 h-8 rounded-xl gradient-bg grid place-items-center text-white font-bold text-sm">B</div>
<span class="text-base font-semibold">Bookly</span>
</div>
<p class="text-sm text-black/50 max-w-xs"><?= t('footer.tagline') ?></p>
</div>
<div>
<div class="text-xs font-semibold uppercase tracking-wider text-black/50 mb-3"><?= t('footer.product') ?></div>
<ul class="space-y-2 text-sm text-black/70">
<li><a href="#features" class="hover:text-[#0071E3]"><?= t('nav.features') ?></a></li>
<li><a href="#addons" class="hover:text-[#0071E3]"><?= t('nav.addons') ?></a></li>
<li><a href="#pricing" class="hover:text-[#0071E3]"><?= t('nav.pricing') ?></a></li>
<li><a href="/blog" class="hover:text-[#0071E3]">Blog</a></li>
</ul>
</div>
<div>
<div class="text-xs font-semibold uppercase tracking-wider text-black/50 mb-3"><?= t('footer.resources') ?></div>
<ul class="space-y-2 text-sm text-black/70">
<li><a href="/book/studio-demo" class="hover:text-[#0071E3]"><?= t('nav.demo') ?></a></li>
<li><a href="/login" class="hover:text-[#0071E3]"><?= t('nav.signin') ?></a></li>
<li><a href="/install" class="hover:text-[#0071E3]"><?= t('nav.getstarted') ?></a></li>
</ul>
</div>
<div>
<div class="text-xs font-semibold uppercase tracking-wider text-black/50 mb-3">Company</div>
<ul class="space-y-2 text-sm text-black/70">
<li><a href="#" class="hover:text-[#0071E3]">About</a></li>
<li><a href="#" class="hover:text-[#0071E3]">Contact</a></li>
<li><a href="#" class="hover:text-[#0071E3]">Privacy</a></li>
</ul>
</div>
</div>
<div class="max-w-6xl mx-auto mt-10 pt-6 border-t border-black/5 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-black/40">
<div>© <?= t('footer.copy', ['year' => date('Y')]) ?></div>
<div><?= t('footer.made') ?></div>
</div>
</footer>

</body>
</html>
