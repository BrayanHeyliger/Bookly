<?php
$__use_data = $__data;
$__view = isset($__data['_view']) ? str_replace('.', '/', $__data['_view']) : '';
?><!DOCTYPE html>
<html lang="<?= e(\Bookly\Support\Language::current()) ?>" dir="<?= e(\Bookly\Support\Language::dir()) ?>" class="bg-[#F5F5F7]">
<head>
<meta charset="UTF-8">
<title><?= e($__data['title'] ?? 'Bookly') ?></title>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
body { font-family: 'Inter', system-ui, -apple-system, 'SF Pro Display', sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.apple-card { background: #fff; border-radius: 24px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
.btn-primary { background: #0071E3; color: #fff; padding: 12px 24px; border-radius: 12px; font-weight: 500; transition: all .25s; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: .5rem; justify-content: center; text-decoration: none; }
.btn-primary:hover { background: #0066CC; }
.input { width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #E5E5EA; }
.input:focus { outline: none; border-color: #0071E3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
.label { display:block; font-size:.8125rem; font-weight:500; margin-bottom:.375rem; }
</style>
</head>
<body class="min-h-screen">
<?php
$__viewFile = BOOKLY_ROOT.'/resources/views/'.$__view.'.php';
if (is_file($__viewFile)) { extract($__use_data, EXTR_SKIP); require $__viewFile; }
?>
</body>
</html>
