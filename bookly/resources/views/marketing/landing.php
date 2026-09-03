<?php
$__data = $__data ?? get_defined_vars();
$__use_data = $__data;
$__view = 'marketing.landing';
?><!DOCTYPE html>
<html lang="<?= e(\Bookly\Support\Language::current()) ?>" dir="<?= e(\Bookly\Support\Language::dir()) ?>" class="bg-white">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bookly — Reservas, directorio y gestión para negocios y profesionales</title>
<meta name="description" content="Bookly: agenda online, página de reservas pública y directorio de profesionales para barberías, salones, spas, independientes y más.">
<script src="https://cdn.tailwindcss.com"></script>
<style>
body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.gradient-text { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
.gradient-bg { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); }
.glass { background: rgba(255,255,255,0.72); backdrop-filter: saturate(180%) blur(20px); -webkit-backdrop-filter: saturate(180%) blur(20px); }
.apple-card { background: #fff; border-radius: 20px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.04); }
.btn-primary { background: #0071E3; color: #fff; padding: 12px 24px; border-radius: 999px; font-weight: 500; transition: all .25s; display:inline-flex; align-items:center; gap:.5rem; cursor: pointer; border: none; text-decoration: none; }
.btn-primary:hover { background: #0066CC; transform: translateY(-1px); }
.btn-ghost { padding: 12px 24px; border-radius: 999px; font-weight: 500; color: #1D1D1F; transition: all .25s; cursor: pointer; background: transparent; border: none; text-decoration: none; }
.btn-ghost:hover { background: rgba(0,0,0,0.05); }
.pill { display:inline-flex; align-items:center; gap:.375rem; padding:6px 14px; border-radius:999px; font-size:.8125rem; font-weight:500; }
.section { padding: 72px 24px; }
@media (max-width: 768px) { .section { padding: 56px 20px; } }
</style>
</head>
<body class="antialiased">

<nav class="glass fixed top-0 left-0 right-0 z-50 border-b border-black/5">
<div class="max-w-6xl mx-auto px-6 h-14 flex items-center justify-between">
<a href="/" class="flex items-center gap-2 no-underline">
<div class="w-8 h-8 rounded-xl gradient-bg grid place-items-center text-white font-bold text-sm">B</div>
<span class="text-base font-semibold tracking-tight text-[#1D1D1F]">Bookly</span>
</a>
<div class="hidden md:flex items-center gap-6 text-sm font-medium text-[#1D1D1F]">
<a href="#negocios" class="hover:text-[#0071E3] transition">Negocios</a>
<a href="#independientes" class="hover:text-[#0071E3] transition">Independientes</a>
<a href="/explore" class="hover:text-[#0071E3] transition">Directorio</a>
</div>
<div class="flex items-center gap-2">
<?= \Bookly\Support\LanguageSwitcher::render() ?>
<a href="/login" class="btn-ghost text-sm">Entrar</a>
<a href="/install" class="btn-primary text-sm">Crear mi cuenta</a>
</div>
</div>
</nav>

<section class="section pt-28">
<div class="max-w-5xl mx-auto text-center">
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4">Plataforma de reservas y directorio</div>
<h1 class="text-4xl md:text-6xl font-semibold tracking-tight">Reservas más simples.<span class="gradient-text"> Negocios con más clientes.</span></h1>
<p class="text-lg md:text-xl text-black/60 mt-4 max-w-2xl mx-auto">Gestioná turnos, cobrás online y aparecés en el directorio público. Para negocios, estudios y profesionales independientes.</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
<a href="/install" class="btn-primary">Empezar gratis</a>
<a href="/explore" class="btn-ghost border border-black/10">Explorar directorio</a>
</div>
</div>
</section>

<section id="negocios" class="section bg-[#F5F5F7]">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-10">
<div class="pill bg-white text-[#0071E3] mb-3">🏢 Negocios</div>
<h2 class="text-3xl md:text-4xl font-semibold">Si tenés un local o equipo</h2>
<p class="text-black/60 mt-2">Todo lo que necesitás para operar turnos, cobrar y fidelizar.</p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Agenda y calendario</div><p class="text-sm text-black/60">Turnos por servicio, staff y sucursal. Disponibilidad en tiempo real.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Cobros y señal</div><p class="text-sm text-black/60">Stripe, señal online, facturación y seguimiento de pagos.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Recordatorios</div><p class="text-sm text-black/60">Email y SMS automáticos para reducir faltas.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Clientes y CRM</div><p class="text-sm text-black/60">Historial, notas y segmentación.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Reviews y reputación</div><p class="text-sm text-black/60">Reseñas verificadas para generar confianza.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Reportes</div><p class="text-sm text-black/60">Ingresos, ocupación y rendimiento por servicio.</p></div>
</div>
</div>
</section>

<section id="independientes" class="section">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-10">
<div class="pill bg-[#E8F3FF] text-[#0071E3] mb-3">🧑‍💼 Independientes</div>
<h2 class="text-3xl md:text-4xl font-semibold">Si trabajás por tu cuenta</h2>
<p class="text-black/60 mt-2">Tu propia página de reservas, sin complicaciones y con cobro integrado.</p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Página pública</div><p class="text-sm text-black/60">Tu link personal para que reserven cuando quieras.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Agenda simple</div><p class="text-sm text-black/60">Configurá tus servicios y horarios en minutos.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Cobro online</div><p class="text-sm text-black/60">Señal o pago total al reservar.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Recordatorios</div><p class="text-sm text-black/60">Email y SMS automáticos sin hacer nada.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Reputación</div><p class="text-sm text-black/60">Reseñas y calificación para ganar visibilidad.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">0 comisión por reserva</div><p class="text-sm text-black/60">Pagás solo por el addon que uses.</p></div>
</div>
</div>
</section>

<section class="section bg-[#F5F5F7]">
<div class="max-w-6xl mx-auto">
<div class="text-center mb-10">
<div class="pill bg-white text-[#0071E3] mb-3">📍 Directorio</div>
<h2 class="text-3xl md:text-4xl font-semibold">Encontrá y reservá profesionales</h2>
<p class="text-black/60 mt-2">Clientes buscan por categoría, ciudad y calificación. Tu negocio puede estar ahí.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Buscador público</div><p class="text-sm text-black/60">Por nombre, servicio o ciudad.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Perfiles con reseñas</div><p class="text-sm text-black/60">Servicios, precio, fotos y calificaciones.</p></div>
<div class="apple-card p-6"><div class="text-sm font-semibold mb-1">Reserva directa</div><p class="text-sm text-black/60">Del directorio a tu página en un clic.</p></div>
</div>
</div>
</section>

<section class="section">
<div class="max-w-3xl mx-auto text-center">
<h2 class="text-3xl md:text-4xl font-semibold">Empezá hoy</h2>
<p class="text-black/60 mt-2">Creá tu cuenta, configurá tus servicios y empezá a recibir reservas.</p>
<div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-6">
<a href="/install" class="btn-primary">Crear cuenta</a>
<a href="/explore" class="btn-ghost border border-black/10">Ver directorio</a>
</div>
</div>
</section>

<footer class="border-t border-black/5 py-10 px-6">
<div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3">
<div class="flex items-center gap-2">
<div class="w-7 h-7 rounded-lg gradient-bg grid place-items-center text-white font-bold text-xs">B</div>
<span class="text-sm font-semibold">Bookly</span>
</div>
<div class="text-xs text-black/40">© <?= date('Y') ?> Bookly. Todos los derechos reservados.</div>
</div>
</footer>

</body>
</html>
