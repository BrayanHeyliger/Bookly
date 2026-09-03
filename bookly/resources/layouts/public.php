<?php
$__use_data = $__data;
$__view = isset($__data['_view']) ? str_replace('.', '/', $__data['_view']) : '';
?><!DOCTYPE html>
<html lang="<?= e(\Bookly\Support\Language::current()) ?>" dir="<?= e(\Bookly\Support\Language::dir()) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
<meta name="theme-color" content="#0071E3">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">
<title><?= e($__data['title'] ?? 'Bookly') ?></title>
<style>
html, body { margin: 0; padding: 0; background: #F5F5F7; }
body { font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'SF Pro Display', system-ui, sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; -webkit-text-size-adjust: 100%; overscroll-behavior-y: contain; }
.apple-card { background: #fff; border-radius: 24px; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
</style>
</head>
<body>
<?php
$__viewFile = BOOKLY_ROOT.'/resources/views/'.$__view.'.php';
if (is_file($__viewFile)) { extract($__use_data, EXTR_SKIP); require $__viewFile; }
?>
</body>
</html>
