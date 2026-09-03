<form method="POST" action="/settings" class="apple-card p-6 max-w-2xl space-y-5">
<?= csrf_field() ?>
<div class="text-lg font-semibold">Business settings</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
  <div><label class="label">Business name</label><input class="input" name="name" value="<?= e($business['name'] ?? '') ?>" required></div>
  <div><label class="label">Email</label><input class="input" name="email" type="email" value="<?= e($business['email'] ?? '') ?>"></div>
  <div><label class="label">Phone</label><input class="input" name="phone" type="tel" value="<?= e($business['phone'] ?? '') ?>"></div>
  <div><label class="label">Website</label><input class="input" name="website" value="<?= e($business['website'] ?? '') ?>" placeholder="https://..."></div>
  <div><label class="label">Country</label><input class="input" name="country" value="<?= e($business['country'] ?? 'US') ?>" maxlength="2"></div>
  <div><label class="label">Currency</label><select class="input" name="currency"><option value="USD" <?= ($business['currency'] ?? '') === 'USD' ? 'selected' : '' ?>>USD ($)</option><option value="EUR" <?= ($business['currency'] ?? '') === 'EUR' ? 'selected' : '' ?>>EUR (€)</option><option value="GBP" <?= ($business['currency'] ?? '') === 'GBP' ? 'selected' : '' ?>>GBP (£)</option><option value="MXN" <?= ($business['currency'] ?? '') === 'MXN' ? 'selected' : '' ?>>MXN ($)</option><option value="BRL" <?= ($business['currency'] ?? '') === 'BRL' ? 'selected' : '' ?>>BRL (R$)</option></select></div>
  <div class="sm:col-span-2"><label class="label">Timezone</label><select class="input" name="timezone"><?php foreach (['UTC','America/New_York','America/Los_Angeles','America/Chicago','America/Denver','Europe/London','Europe/Madrid','Europe/Paris','Europe/Berlin','Europe/Rome','America/Sao_Paulo','America/Mexico_City','Asia/Shanghai','Asia/Dubai','Asia/Riyadh'] as $tz): ?><option value="<?= $tz ?>" <?= ($business['timezone'] ?? '') === $tz ? 'selected' : '' ?>><?= $tz ?></option><?php endforeach; ?></select></div>
</div>
<div><label class="label">Address</label><input class="input" name="address" value="<?= e($business['address'] ?? '') ?>"></div>
<div><label class="label">Description</label><textarea class="input" name="description" rows="3"><?= e($business['description'] ?? '') ?></textarea></div>
<button type="submit" class="btn-primary">Save changes</button>
</form>
