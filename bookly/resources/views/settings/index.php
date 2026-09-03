<form method="POST" action="/settings" class="apple-card p-6 max-w-2xl space-y-4">
<?= csrf_field() ?>
<div class="text-lg font-semibold">Business settings</div>
<div><label class="label">Business name</label><input class="input" name="name" value="<?= e($business['name'] ?? '') ?>" required></div>
<div class="grid grid-cols-2 gap-3">
<div><label class="label">Email</label><input class="input" name="email" value="<?= e($business['email'] ?? '') ?>"></div>
<div><label class="label">Phone</label><input class="input" name="phone" value="<?= e($business['phone'] ?? '') ?>"></div>
<div><label class="label">Country (2 letters)</label><input class="input" name="country" value="<?= e($business['country'] ?? 'US') ?>" maxlength="2"></div>
<div><label class="label">Currency</label><input class="input" name="currency" value="<?= e($business['currency'] ?? 'USD') ?>" maxlength="3"></div>
<div><label class="label">Timezone</label><input class="input" name="timezone" value="<?= e($business['timezone'] ?? 'UTC') ?>"></div>
<div><label class="label">Address</label><input class="input" name="address" value="<?= e($business['address'] ?? '') ?>"></div>
</div>
<div><label class="label">Description</label><textarea class="input" name="description" rows="3"><?= e($business['description'] ?? '') ?></textarea></div>
<button class="btn-primary">Save changes</button>
</form>
