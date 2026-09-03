<?php
/** @var array $__data */
$user = $__data['user'] ?? null;
$addonsInstalled = $__data['addonsInstalled'] ?? 0;
$addonsTotal = $__data['addonsTotal'] ?? 10;
$__use_layout = 'app';
$__view = isset($__data['_view']) ? str_replace('.', '/', $__data['_view']) : '';
$__use_data = $__data;
?><!DOCTYPE html>
<html lang="en" class="bg-[#F5F5F7]">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?= csrf_token() ?>">
<title><?= e($__data['title'] ?? 'Bookly') ?> — Bookly</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" defer></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
body { font-family: 'Inter', system-ui, -apple-system, 'SF Pro Display', sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.glass { background: rgba(255,255,255,0.7); backdrop-filter: saturate(180%) blur(20px); -webkit-backdrop-filter: saturate(180%) blur(20px); }
.apple-card { background: #fff; border-radius: 20px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.04); }
.btn-primary { background: #0071E3; color: #fff; padding: 10px 20px; border-radius: 12px; font-weight: 500; transition: all .25s; display:inline-flex; align-items:center; gap:.5rem; cursor: pointer; border: none; font-size: 0.9375rem; }
.btn-primary:hover { background: #0066CC; transform: translateY(-1px); }
.btn-ghost { padding: 10px 20px; border-radius: 12px; font-weight: 500; color: #1D1D1F; transition: all .25s; cursor: pointer; background: transparent; border: none; font-size: 0.9375rem; }
.btn-ghost:hover { background: rgba(0,0,0,0.05); }
.input { width: 100%; padding: 10px 14px; border-radius: 12px; border: 1px solid #E5E5EA; background: #fff; transition: all .2s; }
.input:focus { outline: none; border-color: #0071E3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
.label { display:block; font-size:.8125rem; font-weight:500; color:#1D1D1F; margin-bottom:.375rem; }
.fade-in { animation: fadeIn .5s ease both; }
.slide-up { animation: slideUp .5s cubic-bezier(.16,1,.3,1) both; }
@keyframes fadeIn { from {opacity: 0} to {opacity: 1} }
@keyframes slideUp { from {opacity:0; transform: translateY(12px)} to {opacity:1; transform: translateY(0)} }
.nav-link { display:flex; align-items:center; gap:.75rem; padding:.625rem .875rem; border-radius:12px; color:#1D1D1F; font-weight:500; transition:all .2s; font-size:.9375rem; text-decoration:none; }
.nav-link:hover { background: rgba(0,0,0,0.05); }
.nav-link.active { background:#E8F3FF; color:#0071E3; }
.pill { display:inline-flex; align-items:center; gap:.375rem; padding:6px 12px; border-radius:999px; font-size:.8125rem; font-weight:500; }
</style>
</head>
<body class="min-h-screen">
<div class="flex min-h-screen">
<aside class="w-64 p-4 hidden md:flex flex-col gap-2 border-r border-black/5 bg-white/60 backdrop-blur-xl">
<a href="/dashboard" class="flex items-center gap-2 px-2 py-3">
<div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#0071E3] to-[#5AC8FA] grid place-items-center text-white font-bold">B</div>
<span class="text-lg font-semibold tracking-tight">Bookly</span>
</a>
<nav class="mt-4 flex flex-col gap-1">
<a href="/dashboard" class="nav-link <?= ($_SERVER['REQUEST_URI'] ?? '') === '/dashboard' ? 'active' : '' ?>"><span>📊</span> Dashboard</a>
<a href="/calendar" class="nav-link <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/calendar') ? 'active' : '' ?>"><span>📅</span> Calendar</a>
<a href="/bookings" class="nav-link <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/bookings') ? 'active' : '' ?>"><span>📋</span> Bookings</a>
<a href="/services" class="nav-link <?= ($_SERVER['REQUEST_URI'] ?? '') === '/services' ? 'active' : '' ?>"><span>✂️</span> Services</a>
<a href="/clients" class="nav-link <?= ($_SERVER['REQUEST_URI'] ?? '') === '/clients' ? 'active' : '' ?>"><span>👥</span> Clients</a>
<a href="/reviews" class="nav-link <?= ($_SERVER['REQUEST_URI'] ?? '') === '/reviews' ? 'active' : '' ?>"><span>⭐</span> Reviews</a>
<a href="/reports" class="nav-link <?= ($_SERVER['REQUEST_URI'] ?? '') === '/reports' ? 'active' : '' ?>"><span>📈</span> Reports</a>
<a href="/addons" class="nav-link <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/addons') ? 'active' : '' ?>"><span>🧩</span> Addons</a>
<a href="/settings" class="nav-link <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/settings') ? 'active' : '' ?>"><span>⚙️</span> Settings</a>
</nav>
<div class="mt-auto apple-card p-3 text-sm">
<div class="font-semibold"><?= e($user['name'] ?? 'Guest') ?></div>
<div class="text-xs text-black/50"><?= e($user['email'] ?? '') ?></div>
<form action="/logout" method="POST" class="mt-3"><?= csrf_field() ?>
<button class="btn-ghost w-full text-left text-sm">Log out</button>
</form>
</div>
</aside>
<main class="flex-1 p-6 md:p-10">
<header class="flex items-center justify-between mb-8 fade-in">
<div>
<h1 class="text-3xl font-semibold tracking-tight"><?= e($__data['title'] ?? 'Dashboard') ?></h1>
<p class="text-sm text-black/50 mt-1"><?= e($__data['subtitle'] ?? '') ?></p>
</div>
<div class="flex items-center gap-3">
<span class="pill bg-[#E8F3FF] text-[#0071E3]">🧩 <?= $addonsInstalled ?>/<?= $addonsTotal ?> addons</span>
<span class="pill bg-black/5"><?= date('D, M j') ?></span>
</div>
</header>
<?php if ($ok = flash('ok')): ?>
<div class="apple-card p-4 mb-6 border-l-4 border-[#34C759] fade-in"><?= e($ok) ?></div>
<?php endif; ?>
<?php
$__viewFile = BOOKLY_ROOT.'/resources/views/'.$__view.'.php';
if (is_file($__viewFile)) { extract($__use_data, EXTR_SKIP); require $__viewFile; }
else echo "View not found: ".e($__view);
?>
</main>
</div>
</body>
</html>
