<?php
$__use_data = $__data;
$__view = isset($__data['_view']) ? str_replace('.', '/', $__data['_view']) : '';
?><!DOCTYPE html>
<html lang="en" class="bg-[#F5F5F7]">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Install Bookly</title>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
body { font-family: 'Inter', system-ui, -apple-system, 'SF Pro Display', sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.apple-card { background: #fff; border-radius: 20px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.04); }
.btn-primary { background: #0071E3; color: #fff; padding: 12px 24px; border-radius: 12px; font-weight: 500; transition: all .25s; display:inline-flex; align-items:center; gap:.5rem; cursor: pointer; border: none; text-decoration: none; font-size: 0.9375rem; }
.btn-primary:hover { background: #0066CC; transform: translateY(-1px); }
.btn-ghost { padding: 12px 24px; border-radius: 12px; font-weight: 500; color: #1D1D1F; transition: all .25s; cursor: pointer; background: transparent; border: none; font-size: 0.9375rem; text-decoration: none; }
.btn-ghost:hover { background: rgba(0,0,0,0.05); }
.input { width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #E5E5EA; background: #fff; transition: all .2s; }
.input:focus { outline: none; border-color: #0071E3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
.label { display:block; font-size:.8125rem; font-weight:500; color:#1D1D1F; margin-bottom:.375rem; }
.fade-in { animation: fadeIn .5s ease both; }
.slide-up { animation: slideUp .5s cubic-bezier(.16,1,.3,1) both; }
@keyframes fadeIn { from {opacity: 0} to {opacity: 1} }
@keyframes slideUp { from {opacity:0; transform: translateY(12px)} to {opacity:1; transform: translateY(0)} }
</style>
</head>
<body class="min-h-screen">
<div class="min-h-screen flex flex-col items-center justify-center p-6">
<div class="w-full max-w-3xl slide-up">
<div class="flex items-center gap-3 mb-8">
<div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#0071E3] to-[#5AC8FA] grid place-items-center text-white text-2xl font-bold shadow-lg">B</div>
<div>
<div class="text-2xl font-semibold tracking-tight">Installing Bookly</div>
<div class="text-sm text-black/50">Step <?= ($__data['__current_step'] ?? 0) + 1 ?> of <?= count($__data['__steps']) ?> — <?= e($__data['__steps'][$__data['__current_step']]['name']) ?></div>
</div>
</div>
<?php $progress = ((($__data['__current_step'] ?? 0) + 1) / count($__data['__steps'])) * 100; ?>
<div class="h-1.5 bg-black/5 rounded-full overflow-hidden mb-10">
<div class="h-full bg-gradient-to-r from-[#0071E3] to-[#5AC8FA] transition-all duration-700" style="width: <?= $progress ?>%"></div>
</div>
<div class="apple-card p-8 md:p-12">
<?php
$__viewFile = BOOKLY_ROOT.'/resources/views/'.$__view.'.php';
if (is_file($__viewFile)) { extract($__use_data, EXTR_SKIP); require $__viewFile; }
else echo "View not found: ".e($__view);
?>
</div>
<div class="mt-6 flex items-center justify-between text-xs text-black/50">
<div>© <?= date('Y') ?> Bookly Labs</div>
<div class="flex gap-1.5">
<?php foreach ($__data['__steps'] as $i => $s): ?>
<div class="w-1.5 h-1.5 rounded-full <?= $i <= ($__data['__current_step'] ?? 0) ? 'bg-[#0071E3]' : 'bg-black/10' ?>"></div>
<?php endforeach; ?>
</div>
</div>
</div>
</div>
</body>
</html>
