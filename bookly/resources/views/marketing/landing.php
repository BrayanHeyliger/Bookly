<?php
$__data = $__data ?? get_defined_vars();
$__use_data = $__data;
$__view = 'marketing.landing';
?><!DOCTYPE html>
<html lang="en" class="bg-white">
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
<a href="#memberships" class="hover:text-[#0071E3] transition flex items-center gap-1.5">Memberships <span class="pill bg-[#FF9500] text-white text-[10px] py-0.5 px-1.5">New</span></a>
<a href="#features" class="hover:text-[#0071E3] transition">Features</a>
<a href="#addons" class="hover:text-[#0071E3] transition">Addons</a>
<a href="#pricing" class="hover:text-[#0071E3] transition">Pricing</a>
<a href="/book/studio-demo" class="hover:text-[#0071E3] transition">Demo booking</a>
</div>
<div class="flex items-center gap-2">
<a href="/login" class="btn-ghost text-sm">Sign in</a>
<a href="/install" class="btn-primary text-sm">Get started</a>
</div>
</div>
</nav>

<!-- Hero -->
<header class="hero-bg relative overflow-hidden pt-32 pb-24 px-6">
<div class="glow gradient-bg" style="top: -200px; left: -200px;"></div>
<div class="glow" style="bottom: -200px; right: -200px; background: #AF52DE;"></div>
<div class="max-w-5xl mx-auto text-center relative">
<div class="pill bg-white/60 backdrop-blur border border-black/5 text-[#0071E3] mb-6 slide-up">
<span>💎</span> New: Sell recurring memberships — get paid even when chairs are empty
</div>
<h1 class="gradient-hero-text slide-up text-[#1D1D1F]" style="animation-delay: .1s">
Turn one-time clients into<br>
<span class="gradient-text">monthly members.</span>
</h1>
<p class="text-xl md:text-2xl text-black/60 mt-6 max-w-2xl mx-auto slide-up" style="animation-delay: .2s">
Bookly's all-in-one platform helps barbers, salons, spas and studios grow predictable revenue with memberships, smart reminders and Apple-style design.
</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-10 slide-up" style="animation-delay: .3s">
<a href="/install" class="btn-primary text-base px-7 py-3.5">Get started free →</a>
<a href="/book/studio-demo" class="btn-ghost text-base px-7 py-3.5">Try the demo</a>
</div>
<p class="text-sm text-black/40 mt-4">No credit card required · 14-day free trial · Cancel anytime</p>

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
<div class="text-xs text-black/50 mb-2">Bookings this week</div>
<div class="flex items-end gap-1 h-24">
<?php for ($i = 0; $i < 14; $i++): $h = 20 + sin($i) * 30 + rand(0, 30); ?>
<div class="flex-1 rounded-t gradient-bg" style="height: <?= max(20, $h) ?>%; opacity: <?= 0.5 + $i/30 ?>"></div>
<?php endfor; ?>
</div>
</div>
<div class="p-4 rounded-2xl bg-[#F5F5F7] space-y-2">
<div class="text-xs text-black/50">Today's calendar</div>
<div class="space-y-1.5">
<div class="p-2 rounded-lg bg-white text-xs"><div class="font-medium">Haircut</div><div class="text-black/50">10:00 · Alex</div></div>
<div class="p-2 rounded-lg bg-white text-xs"><div class="font-medium">Beard trim</div><div class="text-black/50">11:30 · Jamie</div></div>
<div class="p-2 rounded-lg bg-white text-xs"><div class="font-medium">Color</div><div class="text-black/50">14:00 · Rita</div></div>
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
<!-- Memberships (the hero feature for selling) -->
<section id="memberships" class="section" style="background: linear-gradient(180deg, #FFFFFF 0%, #F5F5F7 100%);">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-14">
<div class="pill bg-gradient-to-r from-[#FF9500] to-[#FF2D55] text-white mb-4"><span>💎</span> Memberships</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight text-[#1D1D1F]">Predictable revenue, every month.</h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto">Create unlimited membership tiers, charge monthly or weekly, and let clients self-manage from their phone. Built-in dunning, proration and churn analytics.</p>
</div>

<!-- Membership tiers mockup -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-16">
<div class="apple-card p-7">
<div class="flex items-center justify-between">
<div class="text-xs font-semibold uppercase tracking-wider text-black/50">Bronze</div>
<div class="pill bg-[#CD7F32]/10 text-[#CD7F32] text-[10px]">$39 /mo</div>
</div>
<div class="text-2xl font-semibold mt-3">The Basic</div>
<p class="text-sm text-black/60 mt-2">For casual clients who drop in once or twice a month.</p>
<div class="divider my-5"></div>
<ul class="space-y-2.5 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 2 services per month</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 10% off all add-ons</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Priority booking</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Cancel anytime</li>
</ul>
</div>
<div class="apple-card p-7 relative" style="border: 2px solid #FF9500; transform: scale(1.03);">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 pill gradient-bg text-white text-xs" style="background: linear-gradient(135deg, #FF9500, #FF2D55);">Best seller</div>
<div class="flex items-center justify-between">
<div class="text-xs font-semibold uppercase tracking-wider text-[#FF9500]">Gold</div>
<div class="pill bg-[#FF9500]/10 text-[#FF9500] text-[10px]">$89 /mo</div>
</div>
<div class="text-2xl font-semibold mt-3">The Loyal</div>
<p class="text-sm text-black/60 mt-2">The sweet spot. Most members stay on this plan for 14+ months.</p>
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
<div class="text-xs font-semibold uppercase tracking-wider text-black/50">Platinum</div>
<div class="pill bg-[#5AC8FA]/10 text-[#0071E3] text-[10px]">$189 /mo</div>
</div>
<div class="text-2xl font-semibold mt-3">The VIP</div>
<p class="text-sm text-black/60 mt-2">Unlimited everything. For your top 10% clients who want it all.</p>
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
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider">Avg. revenue uplift</div>
</div>
<div class="apple-card p-6 text-center">
<div class="text-3xl md:text-4xl font-semibold gradient-text">12 min</div>
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider">To launch memberships</div>
</div>
<div class="apple-card p-6 text-center">
<div class="text-3xl md:text-4xl font-semibold gradient-text">−47%</div>
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider">No-show rate</div>
</div>
<div class="apple-card p-6 text-center">
<div class="text-3xl md:text-4xl font-semibold gradient-text">14 mo</div>
<div class="text-xs text-black/50 mt-2 uppercase tracking-wider">Avg. member lifetime</div>
</div>
</div>

<!-- 3-step how it works -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
<div class="apple-card p-7 text-center">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold mx-auto">1</div>
<div class="text-lg font-semibold mt-4">Create your tiers</div>
<p class="text-sm text-black/60 mt-2">Pick a name, price, included services, perks and rules. Drag-and-drop builder, no coding.</p>
</div>
<div class="apple-card p-7 text-center">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold mx-auto">2</div>
<div class="text-lg font-semibold mt-4">Sell in-store or online</div>
<p class="text-sm text-black/60 mt-2">Staff enroll clients at checkout. Clients buy on your public page. Stripe handles billing & dunning.</p>
</div>
<div class="apple-card p-7 text-center">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold mx-auto">3</div>
<div class="text-lg font-semibold mt-4">Get paid every month</div>
<p class="text-sm text-black/60 mt-2">Recurring revenue hits your account automatically. Churn, LTV and retention dashboards included.</p>
</div>
</div>
<div class="text-center mt-10">
<a href="/install" class="btn-primary text-base px-7 py-3.5">Start selling memberships today →</a>
<p class="text-xs text-black/40 mt-3">Setup in 12 minutes · No credit card required · 14-day free trial</p>
</div>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Testimonials for memberships -->
<section class="section bg-[#F5F5F7]">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-14">
<div class="pill bg-white text-[#0071E3] mb-4"><span>💬</span> What owners say</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight">Members pay us while they sleep.</h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto">Real businesses. Real numbers. Real predictable revenue.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
<div class="apple-card p-7">
<div class="flex items-center gap-1 text-[#FF9500] text-sm">★★★★★</div>
<p class="text-base text-[#1D1D1F] mt-4 leading-relaxed">"We launched a <strong>$89 Gold membership</strong> on a Saturday. By Monday we had 47 members and <strong>$4,183 in MRR</strong>. Best weekend of the year."</p>
<div class="flex items-center gap-3 mt-6">
<div class="w-10 h-10 rounded-full gradient-bg grid place-items-center text-white font-semibold">JR</div>
<div><div class="text-sm font-semibold">James R.</div><div class="text-xs text-black/50">Owner · Barber Co. NYC</div></div>
</div>
</div>
<div class="apple-card p-7">
<div class="flex items-center gap-1 text-[#FF9500] text-sm">★★★★★</div>
<p class="text-base text-[#1D1D1F] mt-4 leading-relaxed">"I used to live in fear of slow weeks. Now my <strong>Platinum members</strong> pay on the 1st no matter what. Revenue is up <strong>62% YoY</strong>."</p>
<div class="flex items-center gap-3 mt-6">
<div class="w-10 h-10 rounded-full grid place-items-center text-white font-semibold" style="background: linear-gradient(135deg, #FF9500, #FF2D55);">SM</div>
<div><div class="text-sm font-semibold">Sofia M.</div><div class="text-xs text-black/50">Founder · Studio Nine LA</div></div>
</div>
</div>
<div class="apple-card p-7">
<div class="flex items-center gap-1 text-[#FF9500] text-sm">★★★★★</div>
<p class="text-base text-[#1D1D1F] mt-4 leading-relaxed">"Switched from Booksy and saved <strong>$240/month</strong>. The membership dunning alone paid for Bookly for the year. Members love the app."</p>
<div class="flex items-center gap-3 mt-6">
<div class="w-10 h-10 rounded-full grid place-items-center text-white font-semibold" style="background: linear-gradient(135deg, #34C759, #5AC8FA);">AT</div>
<div><div class="text-sm font-semibold">Aisha T.</div><div class="text-xs text-black/50">Owner · Beauty Bar Chicago</div></div>
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
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4"><span>⚖️</span> Bookly vs Booksy</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight">A modern, fairer alternative.</h2>
<p class="text-xl text-black/60 mt-4">Same power, better pricing, Apple-style design.</p>
</div>
<div class="apple-card overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-[#F5F5F7] text-left">
<tr><th class="p-4 font-semibold">Feature</th><th class="p-4 text-center font-semibold text-[#0071E3]">Bookly</th><th class="p-4 text-center font-semibold text-black/50">Booksy</th></tr>
</thead>
<tbody class="divide-y divide-black/5">
<tr><td class="p-4">Monthly price (Pro)</td><td class="p-4 text-center font-semibold text-[#34C759]">$29</td><td class="p-4 text-center text-black/50">$45+</td></tr>
<tr><td class="p-4">Apple-style design</td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-black/30">—</td></tr>
<tr><td class="p-4">Unlimited members</td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-[#FF9500]">Limited by plan</td></tr>
<tr><td class="p-4">Membership dunning</td><td class="p-4 text-center text-[#34C759]">Built-in</td><td class="p-4 text-center text-[#FF9500]">$20/mo extra</td></tr>
<tr><td class="p-4">Public booking page</td><td class="p-4 text-center text-[#34C759]">Free, unlimited</td><td class="p-4 text-center text-[#FF9500]">$25/mo extra</td></tr>
<tr><td class="p-4">WhatsApp reminders</td><td class="p-4 text-center text-[#34C759]">Included</td><td class="p-4 text-center text-[#FF9500]">$15/mo</td></tr>
<tr><td class="p-4">Setup time</td><td class="p-4 text-center text-[#34C759]">12 minutes</td><td class="p-4 text-center text-black/50">2–3 hours</td></tr>
<tr><td class="p-4">14-day free trial</td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-[#FF9500]">No</td></tr>
<tr><td class="p-4">No setup fees, ever</td><td class="p-4 text-center text-[#34C759]">✓</td><td class="p-4 text-center text-[#FF9500]">$99+ setup</td></tr>
</tbody>
</table>
</div>
<p class="text-center text-sm text-black/50 mt-6">Booksy prices reflect public 2026 published rates. Bookly Pro plan at $29/mo saves you <strong class="text-[#1D1D1F]">$192+/year</strong>.</p>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Logos / Social proof -->
<section class="py-12 px-6 border-y border-black/5 bg-[#F5F5F7]/50">
<div class="max-w-6xl mx-auto">
<div class="text-center text-xs uppercase tracking-widest text-black/40 font-medium mb-6">Trusted by 12,000+ service businesses worldwide</div>
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
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4"><span>⚡</span> Features</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight text-[#1D1D1F]">Everything you need to run your business.</h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto">From bookings to payments, notifications to reviews — Bookly handles the heavy lifting so you can focus on your craft.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
<?php
$features = [
    ['icon' => '📅', 'color' => 'gradient-bg', 'title' => 'Smart calendar', 'desc' => 'Day, week and month views. Drag-and-drop, multi-staff, and Google Calendar sync.'],
    ['icon' => '⚡️', 'color' => 'gradient-bg', 'title' => 'Public booking page', 'desc' => 'Share a beautiful booking link. Your clients pick a time in 30 seconds, 24/7.'],
    ['icon' => '💳', 'color' => 'gradient-bg', 'title' => 'Built-in payments', 'desc' => 'Stripe, cash, transfer and tips. Deposits supported to reduce no-shows.'],
    ['icon' => '🔔', 'color' => 'gradient-bg', 'title' => 'Smart reminders', 'desc' => 'Email, SMS, WhatsApp and push. 24h and 1h before each appointment.'],
    ['icon' => '👥', 'color' => 'gradient-bg', 'title' => 'Client CRM', 'desc' => 'Profiles, visit history, notes, favorites and lifetime value at a glance.'],
    ['icon' => '📊', 'color' => 'gradient-bg', 'title' => 'Reports & exports', 'desc' => 'Revenue, occupancy, top services, recurring clients. PDF and Excel exports.'],
    ['icon' => '⭐', 'color' => 'gradient-bg', 'title' => 'Reviews & ratings', 'desc' => 'Collect 5-star reviews with photos after each visit. Boost your Google ranking.'],
    ['icon' => '🌍', 'color' => 'gradient-bg', 'title' => 'Multi-location', 'desc' => 'Manage all your branches from one dashboard with per-location staff and reports.'],
    ['icon' => '🎨', 'color' => 'gradient-bg', 'title' => 'Apple-style design', 'desc' => 'A delightful interface your clients will love. Fast, clean, mobile-first.'],
];
foreach ($features as $f): ?>
<div class="apple-card p-7">
<div class="feature-icon <?= e($f['color']) ?> mb-4"><?= $f['icon'] ?></div>
<div class="text-lg font-semibold text-[#1D1D1F]"><?= e($f['title']) ?></div>
<div class="text-sm text-black/60 mt-2"><?= e($f['desc']) ?></div>
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
<div class="pill bg-white text-[#0071E3] mb-4"><span>🧩</span> Addon Marketplace</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight">A modular platform that grows with you.</h2>
<p class="text-xl text-black/60 mt-4 max-w-2xl mx-auto">Start with the core. Add exactly what you need, when you need it. No bloat, no surprises.</p>
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
<a href="/addons" class="btn-link">Explore the full marketplace →</a>
</div>
</div>
</section>

<div class="divider max-w-4xl mx-auto"></div>

<!-- Pricing -->
<section id="pricing" class="section">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-16">
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4"><span>💎</span> Pricing</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight">Simple, transparent pricing.</h2>
<p class="text-xl text-black/60 mt-4">Start free. Upgrade when you grow. Cancel anytime.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-5xl mx-auto">
<!-- Starter -->
<div class="apple-card p-8">
<div class="text-sm font-medium text-black/50 uppercase tracking-wide">Starter</div>
<div class="mt-3 flex items-baseline gap-1">
<span class="text-5xl font-semibold">$0</span>
<span class="text-black/50">/mo</span>
</div>
<p class="text-sm text-black/60 mt-3">Perfect for a single provider getting started.</p>
<div class="divider my-6"></div>
<ul class="space-y-3 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Up to 1 staff member</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 100 bookings / month</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Public booking page</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Email reminders</li>
<li class="flex gap-2 text-black/30"><span>—</span> SMS & WhatsApp addons</li>
</ul>
<a href="/install" class="btn-ghost w-full text-center mt-6 block">Get started</a>
</div>
<!-- Pro (highlighted) -->
<div class="apple-card p-8 relative" style="border: 2px solid #0071E3; transform: scale(1.02);">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 pill gradient-bg text-white text-xs">Most popular</div>
<div class="text-sm font-medium text-[#0071E3] uppercase tracking-wide">Pro</div>
<div class="mt-3 flex items-baseline gap-1">
<span class="text-5xl font-semibold">$29</span>
<span class="text-black/50">/mo</span>
</div>
<p class="text-sm text-black/60 mt-3">For growing businesses with multiple staff.</p>
<div class="divider my-6"></div>
<ul class="space-y-3 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Up to 10 staff members</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Unlimited bookings</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Stripe payments & deposits</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> SMS + email reminders</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Reviews & reports</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> 3 addons included</li>
</ul>
<a href="/install" class="btn-primary w-full text-center mt-6 block">Start 14-day trial</a>
</div>
<!-- Business -->
<div class="apple-card p-8">
<div class="text-sm font-medium text-black/50 uppercase tracking-wide">Business</div>
<div class="mt-3 flex items-baseline gap-1">
<span class="text-5xl font-semibold">$79</span>
<span class="text-black/50">/mo</span>
</div>
<p class="text-sm text-black/60 mt-3">For multi-location brands and chains.</p>
<div class="divider my-6"></div>
<ul class="space-y-3 text-sm">
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Unlimited staff & locations</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Everything in Pro</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> All addons included</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> White-label booking page</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> Priority support</li>
<li class="flex gap-2"><span class="text-[#34C759]">✓</span> API access</li>
</ul>
<a href="/install" class="btn-ghost w-full text-center mt-6 block">Contact sales</a>
</div>
</div>
<p class="text-center text-sm text-black/40 mt-8">All plans include unlimited clients, Apple-style UI, and 24/7 support.</p>
</div>
</section>

<!-- Final CTA -->
<section class="section bg-[#1D1D1F] text-white relative overflow-hidden">
<div class="glow" style="top: -100px; left: 20%; background: #FF9500; opacity: 0.25;"></div>
<div class="glow" style="bottom: -100px; right: 20%; background: #0071E3; opacity: 0.25;"></div>
<div class="max-w-3xl mx-auto text-center relative">
<div class="pill bg-white/10 text-white border border-white/20 mb-6">💎 Limited offer: First 100 get 3 months free</div>
<h2 class="text-4xl md:text-5xl font-semibold tracking-tight">Start your membership program today.</h2>
<p class="text-xl text-white/60 mt-4">Set up in 12 minutes. First members on us. Cancel anytime.</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
<a href="/install" class="btn-primary text-base px-7 py-3.5" style="background: #FF9500;">Get started free →</a>
<a href="/book/studio-demo" class="text-white/80 hover:text-white px-7 py-3.5 text-base">Try the demo →</a>
</div>
<p class="text-xs text-white/40 mt-6">No credit card · 14-day trial · Join 12,000+ owners</p>
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
<p class="text-sm text-black/50 max-w-xs">The booking platform built for service professionals.</p>
</div>
<div>
<div class="text-xs font-semibold uppercase tracking-wider text-black/50 mb-3">Product</div>
<ul class="space-y-2 text-sm text-black/70">
<li><a href="#features" class="hover:text-[#0071E3]">Features</a></li>
<li><a href="#addons" class="hover:text-[#0071E3]">Addons</a></li>
<li><a href="#pricing" class="hover:text-[#0071E3]">Pricing</a></li>
</ul>
</div>
<div>
<div class="text-xs font-semibold uppercase tracking-wider text-black/50 mb-3">Resources</div>
<ul class="space-y-2 text-sm text-black/70">
<li><a href="/book/studio-demo" class="hover:text-[#0071E3]">Demo booking</a></li>
<li><a href="/login" class="hover:text-[#0071E3]">Sign in</a></li>
<li><a href="/install" class="hover:text-[#0071E3]">Get started</a></li>
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
<div>© <?= date('Y') ?> Bookly Labs. All rights reserved.</div>
<div>Made with care for service professionals.</div>
</div>
</footer>

</body>
</html>
