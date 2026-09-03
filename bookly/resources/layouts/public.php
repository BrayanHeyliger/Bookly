<?php
$__use_data = $__data;
$__view = isset($__data['_view']) ? str_replace('.', '/', $__data['_view']) : '';
?><!DOCTYPE html>
<html lang="<?= e(\Bookly\Support\Language::current()) ?>" dir="<?= e(\Bookly\Support\Language::dir()) ?>" class="bg-white">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($__data['title'] ?? 'Bookly') ?></title>
<meta name="description" content="Discover and book top-rated barbers, salons, spas and studios near you. Book instantly, 24/7.">
<script src="https://cdn.tailwindcss.com"></script>
<style>
body { font-family: 'Inter', system-ui, -apple-system, 'SF Pro Display', sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.gradient-text { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
.gradient-bg { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); }
.glass { background: rgba(255,255,255,0.72); backdrop-filter: saturate(180%) blur(20px); -webkit-backdrop-filter: saturate(180%) blur(20px); }
.apple-card { background: #fff; border-radius: 20px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.04); }
.btn-primary { background: #0071E3; color: #fff; padding: 10px 20px; border-radius: 12px; font-weight: 500; transition: all .25s; display:inline-flex; align-items:center; gap:.5rem; cursor: pointer; border: none; text-decoration: none; font-size: 0.9375rem; }
.btn-primary:hover { background: #0066CC; transform: translateY(-1px); }
.pill { display:inline-flex; align-items:center; gap:.375rem; padding:6px 12px; border-radius:999px; font-size:.8125rem; font-weight:500; }
.section { padding: 80px 24px; }
@media (max-width: 768px) { .section { padding: 48px 20px; } }
.fade-in { animation: fadeIn .5s ease both; }
.slide-up { animation: slideUp .5s cubic-bezier(.16,1,.3,1) both; }
@keyframes fadeIn { from {opacity: 0} to {opacity: 1} }
@keyframes slideUp { from {opacity:0; transform: translateY(12px)} to {opacity:1; transform: translateY(0)} }
.hero-bg { background: linear-gradient(180deg, #F5F5F7 0%, #FFFFFF 100%); }
</style>
</head>
<body class="antialiased">
<?php
$__viewFile = BOOKLY_ROOT.'/resources/views/'.$__view.'.php';
if (is_file($__viewFile)) { extract($__use_data, EXTR_SKIP); require $__viewFile; }
else echo "View not found: ".e($__view);
?>
</body>
</html>
