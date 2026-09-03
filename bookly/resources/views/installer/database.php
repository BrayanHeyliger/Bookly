<h2 class="text-2xl font-semibold tracking-tight">Database configuration</h2>
<p class="text-black/50 mt-1">Connect Bookly to your database. We'll test the connection live.</p>
<form id="dbForm" class="mt-8 space-y-4" x-data="{ conn: 'sqlite', testing: false, result: null }">
<div>
<label class="label">Database driver</label>
<div class="grid grid-cols-2 gap-2">
<label class="cursor-pointer p-4 rounded-2xl border border-black/10 has-[:checked]:border-[#0071E3] has-[:checked]:bg-[#E8F3FF]">
<input type="radio" name="connection" value="sqlite" x-model="conn" class="hidden" checked>
<div class="font-medium">SQLite</div>
<div class="text-xs text-black/50 mt-1">Zero configuration. Perfect for getting started.</div>
</label>
<label class="cursor-pointer p-4 rounded-2xl border border-black/10 has-[:checked]:border-[#0071E3] has-[:checked]:bg-[#E8F3FF] opacity-60 cursor-not-allowed">
<input type="radio" name="connection" value="mysql" x-model="conn" class="hidden" disabled>
<div class="font-medium">MySQL</div>
<div class="text-xs text-black/50 mt-1">Recommended for production (configure .env later).</div>
</label>
</div>
</div>
<div x-show="conn === 'sqlite'">
<label class="label">Database file path</label>
<input class="input" name="database" value="storage/bookly.sqlite" readonly>
<p class="text-xs text-black/50 mt-1">SQLite is zero-config — Bookly will create the file automatically.</p>
</div>
<div class="flex items-center gap-3 pt-2">
<button type="button" class="btn-ghost" @click="testing = true; result = null; fetch('/install/test-db', { method:'POST' }).then(r => r.json()).then(d => { result = d; testing = false; })">Test connection</button>
<template x-if="testing"><span class="text-sm text-black/50">Testing…</span></template>
<template x-if="result && result.ok"><span class="text-sm text-[#34C759] font-medium">✓ Connection successful.</span></template>
<template x-if="result && !result.ok"><span class="text-sm text-[#FF3B30] font-medium" x-text="'✗ ' + result.message"></span></template>
</div>
<div class="pt-6 flex items-center justify-between">
<a href="/install/requirements" class="btn-ghost">← Back</a>
<button type="submit" class="btn-primary">Continue →</button>
</div>
</form>
