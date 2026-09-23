<?php
$__data = $__data ?? get_defined_vars();
$__use_data = $__data;
$__view = 'marketing.landing';
$installed = $installed ?? file_exists(BOOKLY_ROOT.'/storage/installed.lock');

// Statistics for counters
$stats = [
  ['value' => '10k+', 'label' => 'Active Businesses', 'icon' => '🏢'],
  ['value' => '500k+', 'label' => 'Monthly Appointments', 'icon' => '📅'],
  ['value' => '50+', 'label' => 'Countries', 'icon' => '🌍'],
  ['value' => '4.9', 'label' => 'User Rating', 'icon' => '⭐'],
];

// Testimonios
$testimonials = [
  ['name' => 'María Gómez', 'role' => 'Luna Salon', 'rating' => 5, 'text' => 'Bookly transformed my business. Managing appointments and payments has never been easier.'],
  ['name' => 'Carlos Díaz', 'role' => 'Barber', 'rating' => 5, 'text' => 'Simple, reliable, and my clients love it. Bookings are now automatic!'],
  ['name' => 'Ana Rodríguez', 'role' => 'Esthetician', 'rating' => 5, 'text' => 'The mobile app is perfect. I can manage my schedule anywhere.'],
  ['name' => 'Luis Martínez', 'role' => 'Spa Owner', 'rating' => 5, 'text' => 'Multi-location support saved our business. Easy to use dashboard.'],
];

// Plans
$plans = [
  ['name' => 'Professional', 'price' => 'Free', 'period' => 'forever', 'popular' => false, 
   'features' => ['Unlimited appointments', 'Client management', 'Online payments', 'Public booking page']],
  ['name' => 'Business', 'price' => 'Free', 'period' => '30 days', 'popular' => true,
   'features' => ['All Professional features', 'Multiple locations', 'Team management', 'Inventory tracking']],
  ['name' => 'Multi-Location', 'price' => 'Free', 'period' => '30 days', 'popular' => false,
   'features' => ['All Business features', 'Unlimited locations', 'Centralized reporting', 'Priority support']],
];
?>
<!DOCTYPE html>
<html lang="<?= e(\Bookly\Support\Language::current()) ?>" dir="<?= e(\Bookly\Support\Language::dir()) ?>" class="bg-white">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bookly — Online Booking & Business Directory</title>
<meta name="description" content="Bookly: online scheduling, public booking pages, and business directory for salons, spas, barbers, professionals and more.">
<script src="https://cdn.tailwindcss.com"></script>
<style>
body { font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'SF Pro Display', sans-serif; -webkit-font-smoothing: antialiased; color: #1D1D1F; }
.glass { background: rgba(255,255,255,0.72); backdrop-filter: saturate(180%) blur(20px); }
.apple-card { background: #fff; border-radius: 20px; box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 4px 16px rgba(0,0,0,0.04); }
.btn-primary { background: #0071E3; color: #fff; padding: 12px 24px; border-radius: 999px; font-weight: 500; transition: all .25s; display:inline-flex; align-items:center; gap:.5rem; cursor: pointer; border: none; text-decoration: none; }
.btn-primary:hover { background: #0066CC; transform: translateY(-1px); }
.btn-ghost { padding: 12px 24px; border-radius: 999px; font-weight: 500; color: #1D1D1F; transition: all .25s; cursor: pointer; text-decoration: none; }
.btn-ghost:hover { background: rgba(0,0,0,0.05); }
.pill { display:inline-flex; align-items:center; gap:.375rem; padding:6px 14px; border-radius:999px; font-size:.8125rem; font-weight:500; }
.section { padding: 72px 24px; }
@media (max-width: 768px) { .section { padding: 56px 20px; } }
.gradient-text { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
.gradient-bg { background: linear-gradient(135deg, #0071E3 0%, #5AC8FA 100%); }
.fade-in { animation: fadeIn .5s ease both; opacity: 0; }
.slide-up { animation: slideUp .5s cubic-bezier(.16,1,.3,1) both; }
@keyframes fadeIn { from {opacity: 0} to {opacity: 1} }
@keyframes slideUp { from {opacity:0; transform: translateY(12px)} to {opacity:1; transform: translateY(0)} }
</style>
</head>
<body class="antialiased">

<nav class="glass fixed top-0 left-0 right-0 z-50 border-b border-black/5">
  <div class="max-w-6xl mx-auto px-6 h-14 flex items-center justify-between">
    <a href="/" class="flex items-center gap-2 no-underline">
      <div class="w-8 h-8 rounded-xl gradient-bg grid place-items-center text-white font-bold text-sm">B</div>
      <span class="text-base font-semibold tracking-tight text-[#1D1D1F]">Bookly</span>
    </a>
    <div class="hidden md:flex items-center gap-6 text-sm font-medium text-[#1D1D1F]">
      <a href="#categorias" class="hover:text-[#0071E3] transition">Categories</a>
      <a href="#caracteristicas" class="hover:text-[#0071E3] transition">Features</a>
      <a href="#precios" class="hover:text-[#0071E3] transition">Pricing</a>
      <a href="/explore" class="hover:text-[#0071E3] transition">Directory</a>
    </div>
    <div class="flex items-center gap-2">
      <?= \Bookly\Support\LanguageSwitcher::render() ?>
      <?php if ($installed): ?>
        <a href="/login" class="btn-ghost text-sm">Sign In</a>
        <a href="/register" class="btn-primary text-sm">Create Account</a>
      <?php else: ?>
        <a href="/install" class="btn-ghost text-sm">Get Started</a>
        <a href="/register" class="btn-primary text-sm">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Statistics Counters -->
<div class="pt-16 pb-4 bg-white border-b border-black/5">
  <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
    <?php foreach ($stats as $stat): ?>
      <div class="fade-in" style="animation-delay: <?= 0.1 * array_search($stat, $stats) ?>s">
        <div class="text-2xl font-bold gradient-text"><?= $stat['value'] ?></div>
        <div class="text-xs text-black/50"><?= $stat['label'] ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Hero Section -->
<section class="section pt-28">
  <div class="max-w-5xl mx-auto text-center">
    <div class="pill bg-[#E8F3FF] text-[#0071E3] mb-4">Online Booking Platform</div>
    <h1 class="text-4xl md:text-6xl font-semibold tracking-tight">Book appointments.<span class="gradient-text"> Grow your business.</span></h1>
    <p class="text-lg md:text-xl text-black/60 mt-4 max-w-2xl mx-auto">
      Schedule appointments, accept online payments, and appear in our public directory. 
      For businesses, studios, and independent professionals.
    </p>
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
      <?php if ($installed): ?>
        <a href="/register" class="btn-primary">Create Account</a>
      <?php else: ?>
        <a href="/install" class="btn-primary">Start Free</a>
      <?php endif; ?>
      <a href="/explore" class="btn-ghost border border-black/10">View Directory</a>
    </div>
  </div>
</section>

<!-- Mobile App Section -->
<section class="section bg-[#F5F5F7]">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-white text-[#0071E3] mb-3">📱 Mobile App</div>
      <h2 class="text-3xl md:text-4xl font-semibold">Manage your business on the go</h2>
      <p class="text-black/60 mt-2">Available on iOS and Android. Full access to your calendar, clients, and payments.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
      <div class="fade-in">
        <div class="bg-white rounded-2xl shadow-xl p-6 apple-card">
          <div class="text-sm text-black/50 mb-2">iPhone App Preview</div>
          <div class="aspect-square bg-gradient-to-br from-[#0071E3] to-[#5AC8FA] rounded-xl flex items-center justify-center">
            <div class="text-white text-center p-6">
              <div class="text-4xl mb-3">📱</div>
              <div class="font-bold text-xl mb-2">Bookly App</div>
              <div class="text-sm opacity-90">Calendar • Clients • Payments • Reviews</div>
            </div>
          </div>
          <a href="https://apps.apple.com" class="btn-primary w-full mt-4">App Store</a>
          <a href="https://play.google.com" class="btn-ghost w-full mt-2">Google Play</a>
        </div>
      </div>
      <div class="fade-in">
        <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=600&h=400&fit=crop" alt="Mobile app" class="w-full rounded-2xl shadow-xl apple-card">
      </div>
    </div>
  </div>
</section>

<!-- Categories Section -->
<section id="categorias" class="section">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-[#E8F3FF] text-[#0071E3] mb-3">📁 Categories</div>
      <h2 class="text-3xl md:text-4xl font-semibold">All types of professionals</h2>
      <p class="text-black/60 mt-2">A platform adapted to every specialty in the beauty world.</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
      <!-- 9 categories -->
    </div>
  </div>
</section>

<!-- Pricing Section -->
<section id="precios" class="section bg-[#F5F5F7]">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-white text-[#0071E3] mb-3">💰 Pricing</div>
      <h2 class="text-3xl md:text-4xl font-semibold">Free plans for all sizes</h2>
      <p class="text-black/60 mt-2">No contracts. Cancel anytime. Free forever for clients.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php foreach ($plans as $i => $plan): ?>
        <div class="apple-card p-6 fade-in <?= $plan['popular'] ? 'border-2 border-[#0071E3]' : 'border border-black/5' ?>" style="animation-delay: <?= 0.1 * $i ?>s">
          <div class="text-center mb-4">
            <?php if ($plan['popular']): ?>
              <span class="pill bg-[#0071E3] text-white mb-3">Most Popular</span>
            <?php endif; ?>
            <h3 class="text-xl font-semibold"><?= $plan['name'] ?></h3>
            <div class="text-3xl font-bold gradient-text mt-2">
              <?php if ($plan['price'] === 'Free'): ?>
                Free
              <?php else: ?>
                $<?= $plan['price'] ?>
              <?php endif; ?>
              <?php if ($plan['period']): ?>
                <span class="text-base font-normal text-black/50">/<?= $plan['period'] ?></span>
              <?php endif; ?>
            </div>
          </div>
          <ul class="space-y-3 text-sm">
            <?php foreach ($plan['features'] as $feature): ?>
              <li class="flex items-center gap-2">
                <span class="text-green-500">✓</span>
                <span class="text-black/60"><?= $feature ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php if ($installed): ?>
            <a href="/register" class="btn-primary w-full mt-6">Get Started</a>
          <?php else: ?>
            <a href="/install" class="btn-primary w-full mt-6">Start Free</a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="section">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-[#E8F3FF] text-[#0071E3] mb-3">⭐ Testimonials</div>
      <h2 class="text-3xl md:text-4xl font-semibold">What our users say</h2>
      <p class="text-black/60 mt-2">Trusted by thousands of businesses worldwide</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php foreach ($testimonials as $i => $testimonial): ?>
        <div class="apple-card p-6 fade-in" style="animation-delay: <?= 0.1 * $i ?>s">
          <div class="flex items-center mb-3">
            <div class="flex text-yellow-400">
              <?php for($j = 0; $j < 5; $j++): ?>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 3.6l2.13 4.29A.8.8 0 0017 9.53a.8.8 0 01-2.5 0l-1.8-2.25-2.33.43a.8.8 0 00-.55.15.8.8 0 00-.32.81v2.5a.8.8 0 00.8.8h.25a.8.8 0 00.79-.71l.24-1.14 1.9.35a.8.8 0 00.74.45h.26a.8.8 0 00.8-.8V8.2a.8.8 0 00-.8-.8h-.26a.8.8 0 00-.74.45l-1.9.35 1.13 1.14a.8.8 0 00.32.81.8.8 0 00-.54.15L8.87 13.43A.8.8 0 008 12.54V9.53a.8.8 0 00-.8-.8H6.8a.8.8 0 00-.8.8v1.43a.8.8 0 00.2.55l1.13 1.14-1.9.35A.8.8 0 004 10.54a.8.8 0 00.08-.32V8.2a.8.8 0 00.8-.8h.26a.8.8 0 00.74.45l1.9.35-1.13 1.14a.8.8 0 00-.32.81.8.8 0 00.54.15L4.87 11.72A.8.8 0 005 12.54V15.5a.8.8 0 00.8.8h.26a.8.8 0 00.8-.8v-1.43a.8.8 0 00-.8-.8H6.8z"/></svg>
              <?php endfor; ?>
            </div>
          </div>
          <p class="text-black/60 mb-3">"<?= $testimonial['text'] ?>"</p>
          <div class="font-semibold"><?= $testimonial['name'] ?></div>
          <div class="text-sm text-black/50"><?= $testimonial['role'] ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="section bg-[#F5F5F7]">
  <div class="max-w-3xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-white text-[#0071E3] mb-3">❓ FAQ</div>
      <h2 class="text-3xl md:text-4xl font-semibold">Frequently asked questions</h2>
    </div>
    <div class="space-y-4">
      <div class="apple-card p-4 fade-in">
        <h4 class="font-semibold mb-2">Is it free for clients?</h4>
        <p class="text-sm text-black/60">Yes! Clients can book appointments for free. They just need to create an account.</p>
      </div>
      <div class="apple-card p-4 fade-in">
        <h4 class="font-semibold mb-2">What payment methods are supported?</h4>
        <p class="text-sm text-black/60">We support Stripe for credit cards, PayPal, and local payment methods. Payments can be in USD or local currency.</p>
      </div>
      <div class="apple-card p-4 fade-in">
        <h4 class="font-semibold mb-2">Can I manage multiple locations?</h4>
        <p class="text-sm text-black/60">Yes, the Business and Multi-Location plans support unlimited locations with team management.</p>
      </div>
      <div class="apple-card p-4 fade-in">
        <h4 class="font-semibold mb-2">Is there a mobile app?</h4>
        <p class="text-sm text-black/60">Yes, available on both iOS and Android. Download from App Store or Google Play.</p>
      </div>
    </div>
  </div>
</section>

<!-- Final CTA -->
<section class="section">
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="text-4xl md:text-5xl font-semibold mb-4">Ready to get started?</h2>
    <p class="text-lg text-black/60 mb-6">Create your account, set up your services, and start receiving bookings today.</p>
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
      <?php if ($installed): ?>
        <a href="/register" class="btn-primary">Create Account</a>
      <?php else: ?>
        <a href="/install" class="btn-primary">Start Free</a>
      <?php endif; ?>
      <a href="/explore" class="btn-ghost border border-black/10">View Directory</a>
    </div>
  </div>
</section>

<footer class="border-t border-black/5 py-10 px-6">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3">
    <div class="flex items-center gap-2">
      <div class="w-7 h-7 rounded-lg gradient-bg grid place-items-center text-white font-bold text-xs">B</div>
      <span class="text-sm font-semibold">Bookly</span>
    </div>
    <div class="text-xs text-black/40">© <?= date('Y') ?> Bookly. Todos los derechos reservados.</div>
  </div>
</footer>

</body>
</html>