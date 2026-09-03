<style>
.cat-card { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:12px; padding:24px 16px; border-radius:20px; background:#fff; border:1px solid rgba(0,0,0,0.06); cursor:pointer; transition:all .2s; text-decoration:none; color:#1D1D1F; }
.cat-card:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(0,0,0,0.08); border-color:#0071E3; }
.cat-icon { width:56px; height:56px; border-radius:16px; display:grid; place-items:center; font-size:28px; background:#F5F5F7; }
.biz-card { background:#fff; border-radius:20px; overflow:hidden; border:1px solid rgba(0,0,0,0.06); transition:all .2s; text-decoration:none; color:inherit; display:block; }
.biz-card:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(0,0,0,0.08); }
.biz-card-img { height:180px; background:linear-gradient(135deg, #E8F3FF, #F5F5F7); display:flex; align-items:center; justify-content:center; font-size:64px; }
.biz-card-body { padding:16px; }
.hero-search { max-width:640px; margin:0 auto; }
.hero-search input { width:100%; padding:16px 20px; border-radius:999px; border:1.5px solid #E5E5EA; font-size:16px; background:#fff; box-shadow:0 4px 24px rgba(0,0,0,0.06); }
.hero-search input:focus { outline:none; border-color:#0071E3; box-shadow:0 4px 24px rgba(0,113,227,0.15); }
</style>

<!-- Public nav -->
<nav class="glass fixed top-0 left-0 right-0 z-50 border-b border-black/5">
<div class="max-w-6xl mx-auto px-6 h-14 flex items-center justify-between">
<a href="/explore" class="flex items-center gap-2 text-decoration-none">
<div class="w-8 h-8 rounded-xl gradient-bg grid place-items-center text-white font-bold text-sm">B</div>
<span class="text-base font-semibold tracking-tight text-[#1D1D1F]">Bookly</span>
</a>
<div class="hidden md:flex items-center gap-7 text-sm font-medium text-[#1D1D1F]">
<a href="/explore" class="hover:text-[#0071E3] transition">Explore</a>
<a href="#categories" class="hover:text-[#0071E3] transition">Categories</a>
<a href="#featured" class="hover:text-[#0071E3] transition">Featured</a>
</div>
<div class="flex items-center gap-2">
<?= \Bookly\Support\LanguageSwitcher::render() ?>
<a href="/login" class="btn-ghost text-sm">Sign in</a>
<a href="/install" class="btn-primary text-sm">Get started</a>
</div>
</div>
</nav>

<div style="padding-top:64px;">

<div class="hero-bg" style="padding:80px 24px 48px; text-align:center;">
  <h1 class="gradient-hero-text slide-up" style="font-size:3rem; font-weight:700; letter-spacing:-0.04em;">Find your next<br><span class="gradient-text">professional.</span></h1>
  <p class="text-xl text-black/60 mt-4 max-w-xl mx-auto slide-up" style="animation-delay:.1s">Discover top-rated barbers, salons, spas and studios near you. Book instantly, 24/7.</p>
  <form class="hero-search mt-8 slide-up" style="animation-delay:.2s" action="/search" method="GET">
    <input type="text" name="q" placeholder="Search by name, service or city..." autofocus>
  </form>
</div>

<section class="section">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-[#E8F3FF] text-[#0071E3] mb-3"><span>💈</span> Categories</div>
      <h2 class="text-3xl md:text-4xl font-semibold">Browse by category</h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
      <?php
      $cats = ['Barber' => '💇', 'Hair Salon' => '💆', 'Nails' => '💅', 'Massage' => '💆‍♀️', 'Skin Care' => '✨', 'Tattoo' => '🖤', 'Piercing' => '💎', 'Spa' => '🧖', 'Makeup' => '💄', 'Wellness' => '🌿'];
      foreach ($cats as $cat => $emoji): ?>
      <a href="/category/<?= urlencode(str_replace(' ', '-', strtolower($cat))) ?>" class="cat-card">
        <div class="cat-icon"><?= $emoji ?></div>
        <div class="text-sm font-semibold text-center"><?= $cat ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section bg-[#F5F5F7]">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-white text-[#0071E3] mb-3"><span>⭐</span> Featured</div>
      <h2 class="text-3xl md:text-4xl font-semibold">Top-rated professionals</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <?php foreach ($featured as $b): ?>
      <a href="/business/<?= e($b['slug']) ?>" class="biz-card">
        <div class="biz-card-img"><?= $b['category'] === 'Barber' ? '💇' : ($b['category'] === 'Hair Salon' ? '💆' : '✨') ?></div>
        <div class="biz-card-body">
          <div class="font-semibold"><?= e($b['name']) ?></div>
          <div class="text-xs text-black/50 mt-1"><?= e($b['city'] ?? '') ?> · <?= e($b['category'] ?? '') ?></div>
          <div class="flex items-center gap-1 mt-2 text-xs"><?= str_repeat('⭐', (int) round($b['avg_rating'])) ?> <span class="text-black/50">(<?= (int)$b['review_count'] ?>)</span></div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
      <div class="pill bg-[#E8F3FF] text-[#0071E3] mb-3"><span>🆕</span> New</div>
      <h2 class="text-3xl md:text-4xl font-semibold">Recently added</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <?php foreach ($recent as $b): ?>
      <a href="/business/<?= e($b['slug']) ?>" class="biz-card">
        <div class="biz-card-img"><?= $b['category'] === 'Barber' ? '💇' : ($b['category'] === 'Hair Salon' ? '💆' : '✨') ?></div>
        <div class="biz-card-body">
          <div class="font-semibold"><?= e($b['name']) ?></div>
          <div class="text-xs text-black/50 mt-1"><?= e($b['city'] ?? '') ?> · <?= e($b['category'] ?? '') ?></div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
