<div class="w-full max-w-md apple-card p-10">
<div class="flex items-center gap-3 mb-8">
<div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#0071E3] to-[#5AC8FA] grid place-items-center text-white font-bold text-lg">B</div>
<div>
<div class="text-xl font-semibold">Welcome back</div>
<div class="text-sm text-black/50">Sign in to Bookly</div>
</div>
</div>
<?php if (! empty($error)): ?>
<div class="mb-4 p-3 rounded-xl bg-[#FFF5F5] border border-[#FF3B30]/20 text-sm text-[#FF3B30]"><?= e($error) ?></div>
<?php endif; ?>
<form method="POST" action="/login" class="space-y-4">
<?= csrf_field() ?>
<div><label class="block text-sm font-medium mb-1.5">Email</label><input class="input" name="email" type="email" required autofocus value="admin@bookly.app"></div>
<div><label class="block text-sm font-medium mb-1.5">Password</label><input class="input" name="password" type="password" required value="password"></div>
<label class="flex items-center gap-2 text-sm text-black/60"><input type="checkbox" name="remember" class="rounded"> Remember me</label>
<button type="submit" class="btn-primary">Sign in</button>
</form>
<div class="mt-6 text-xs text-black/40 text-center">Default: admin@bookly.app / password</div>
</div>
