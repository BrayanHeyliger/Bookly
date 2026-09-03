<?php
$__use_data = $__data;
$__view = isset($__data['_view']) ? str_replace('.', '/', $__data['_view']) : '';
?><!DOCTYPE html>
<html lang="en" class="bg-[#F5F5F7]">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?= csrf_token() ?>">
<title><?= e($__data['title'] ?? 'Sign in') ?> — Bookly</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
body { font-family: 'Inter', system-ui, -apple-system, 'SF Pro Display', sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.apple-card { background: #fff; border-radius: 24px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
.input { width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #E5E5EA; }
.input:focus { outline: none; border-color: #0071E3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
.btn-primary { background: #0071E3; color: #fff; padding: 12px 24px; border-radius: 12px; font-weight: 500; transition: all .25s; cursor: pointer; border: none; width: 100%; }
.btn-primary:hover { background: #0066CC; }
</style>
</head>
<body class="min-h-screen grid place-items-center p-6">
<?php
$__viewFile = BOOKLY_ROOT.'/resources/views/'.$__view.'.php';
if (is_file($__viewFile)) { extract($__use_data, EXTR_SKIP); require $__viewFile; }
?>
</body>
</html>
