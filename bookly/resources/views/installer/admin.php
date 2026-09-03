<h2 class="text-2xl font-semibold tracking-tight">Create your admin account</h2>
<p class="text-black/50 mt-1">This account will have full access to your Bookly workspace.</p>
<?php if (! empty($error)): ?>
<div class="mt-4 p-3 rounded-xl bg-[#FFF5F5] border border-[#FF3B30]/20 text-sm text-[#FF3B30]"><?= e($error) ?></div>
<?php endif; ?>
<form method="POST" action="/install/finish" class="mt-8 space-y-4">
<?= csrf_field() ?>
<input type="hidden" name="connection" value="sqlite">
<input type="hidden" name="database" value="storage/bookly.sqlite">
<div class="grid grid-cols-2 gap-3">
<div class="col-span-2"><label class="label">Business name</label><input class="input" name="business_name" required value="My Bookly"></div>
<div><label class="label">Your name</label><input class="input" name="name" required value="Admin"></div>
<div><label class="label">Email</label><input class="input" name="email" type="email" required value="admin@bookly.app"></div>
<div><label class="label">Password</label><input class="input" name="password" type="password" required minlength="8" value="password"></div>
<div><label class="label">Country</label>
<select class="input" name="country" required>
<option value="US">United States</option><option value="ES">Spain</option><option value="MX">Mexico</option>
<option value="AR">Argentina</option><option value="CO">Colombia</option><option value="GB">United Kingdom</option>
</select>
</div>
<div><label class="label">Timezone</label>
<select class="input" name="timezone" required>
<option value="UTC">UTC</option><option value="America/New_York">America/New_York</option>
<option value="America/Los_Angeles">America/Los_Angeles</option><option value="Europe/Madrid">Europe/Madrid</option>
</select>
</div>
</div>
<div class="pt-6 flex items-center justify-between">
<a href="/install/database" class="btn-ghost">← Back</a>
<button type="submit" class="btn-primary">Install Bookly →</button>
</div>
</form>
