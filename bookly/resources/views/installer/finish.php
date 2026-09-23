<?php
$minLength = 12;
?>
<form method="POST" action="/install/finish" class="space-y-6">
<?= csrf_field() ?>

<?php if (! empty($error)): ?>
<div class="p-4 rounded-xl bg-[#FFF5F5] border border-[#FF3B30]/20 text-sm text-[#FF3B30]"><?= e($error) ?></div>
<?php endif; ?>

<div>
<h2 class="text-2xl font-semibold tracking-tight">Create your administrator account</h2>
<p class="text-black/50 mt-1 text-sm">This is the only account with full access. There are no default credentials.</p>
</div>

<div class="grid md:grid-cols-2 gap-5">
  <div>
    <label class="label">Your name</label>
    <input class="input" name="name" required value="<?= e(old('name')) ?>">
  </div>
  <div>
    <label class="label">Email</label>
    <input class="input" name="email" type="email" required value="<?= e(old('email')) ?>">
  </div>
</div>

<div class="grid md:grid-cols-2 gap-5">
  <div>
    <label class="label">Business name</label>
    <input class="input" name="business_name" required value="<?= e(old('business_name')) ?>">
  </div>
  <div>
    <label class="label">Country</label>
    <input class="input" name="country" value="<?= e(old('country', 'US')) ?>">
  </div>
</div>

<div>
  <label class="label">Timezone</label>
  <input class="input" name="timezone" value="<?= e(old('timezone', 'UTC')) ?>" placeholder="America/New_York">
</div>

<div class="grid md:grid-cols-2 gap-5">
  <div>
    <label class="label">Password</label>
    <input class="input" name="password" type="password" required minlength="<?= $minLength ?>" autocomplete="new-password">
    <p class="text-xs text-black/45 mt-1.5">Minimum <?= $minLength ?> characters, mixing upper-case, lower-case and numbers.</p>
  </div>
  <div>
    <label class="label">Confirm password</label>
    <input class="input" name="password_confirmation" type="password" required minlength="<?= $minLength ?>" autocomplete="new-password">
  </div>
</div>

<label class="flex items-start gap-3 text-sm text-black/70">
  <input type="checkbox" required class="mt-1 rounded">
  <span>I have saved these credentials in my password manager.</span>
</label>

<div class="flex items-center justify-between pt-2">
  <a href="/install/admin" class="btn-ghost">Back</a>
  <button type="submit" class="btn-primary">Install Bookly</button>
</div>
</form>
