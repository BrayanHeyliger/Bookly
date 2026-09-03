# Bookly

> A complete SaaS booking platform for service businesses (barber shops, salons, spas, tattoo studios) with a modular **Addon Marketplace** and a **5-step Installer Wizard** — all in a single self-contained PHP application.

**Stack:** PHP 8.1+ · SQLite (zero-config) · MySQL (optional) · Alpine.js · Tailwind CSS · Chart.js

---

## 🚀 Quick start

```bash
# from inside the bookly/ directory
php -S 0.0.0.0:8000 -t public public/index.php
```

Then open <http://localhost:8000>.

The **Apple-style 5-step Installer Wizard** runs on the very first request:

1. **Welcome** — animated hero
2. **Requirements** — PHP, extensions, folder permissions
3. **Database** — SQLite (default) or MySQL with live connection test
4. **Admin** — name, email, business, country, timezone
5. **Finish** — seeds the platform, creates `storage/installed.lock`, redirects to dashboard

After install, sign in at `/login` with the credentials you created (defaults: `admin@bookly.app` / `password`).

---

## 🧩 Addon Marketplace

10 addons ship out-of-the-box and live at `/addons`:

| Addon | Slug | Price |
|---|---|---|
| WhatsApp Bot | `whatsapp` | $19/mo |
| Memberships | `memberships` | $29/mo |
| Loyalty Program | `loyalty` | $15/mo |
| Gift Cards | `giftcards` | $9/mo |
| POS & Inventory | `pos` | $39/mo |
| Inventory Manager | `inventory` | $19/mo |
| Multi-location | `multi_location` | $49/mo |
| Video Consultations | `video_calls` | $25/mo |
| AI Assistant | `ai_assistant` | $35/mo |
| Waitlist | `waitlist` | $9/mo |

Install via UI (`/addons`) or CLI:

```bash
php artisan.php addon:install whatsapp
php artisan.php addon:list
```

The `AddonManager` keeps the `addons` table in sync with the catalog on every boot — adding a new addon is as simple as adding a new entry to `config/addons.php`.

---

## 🧭 Core modules

- **Auth** — multi-role (Superadmin, Owner, Manager, Staff, Client), password hashing, CSRF, session-based
- **Dashboard** — KPIs (today's bookings, week revenue, new clients, addons), 14-day Chart.js line chart, upcoming + recent activity
- **Calendar** — weekly grid (Mon–Sun), 15-min slots, color-coded status
- **Bookings** — list, detail, delete
- **Services** — name, duration, price, deposit, category, color
- **Clients** — CRM with visits, spend, favorite flag
- **Reviews** — 5-star with comments
- **Reports** — date-range revenue, count, avg ticket, top services
- **Settings** — business profile, country, currency, timezone
- **Addons** — App-Store style cards, install/uninstall/toggle

## 🌐 Public booking page

`/book/{business-slug}` — Apple-style 4-step flow (service → date → time → contact). Slots are fetched live via `/api/slots/{slug}/{serviceId}/{date}`.

## 🛠 CLI (`artisan.php`)

```bash
php artisan.php addon:install {slug}
php artisan.php addon:uninstall {slug}
php artisan.php addon:list
php artisan.php help
```

## 🗂 File structure

```
bookly/
├── index.php                # Web router (closure-based, ~70 lines)
├── artisan.php              # CLI entry point
├── public/
│   └── index.php            # PHP built-in server entry
├── app/
│   ├── helpers.php          # e(), layout(), view(), csrf_token(), …
│   ├── Controllers/         # Installer, Auth, App, PublicBooking, Api
│   ├── Models/              # User
│   └── Support/             # DB, AddonManager
├── config/
│   ├── app.php              # Brand + booking settings
│   └── addons.php           # 10 addons catalog
├── resources/
│   ├── layouts/             # app, installer, public, auth
│   └── views/               # dashboard, calendar, bookings, addons, …
├── storage/                 # bookly.sqlite, installed.lock (auto-created)
└── addons/                  # Reserved for future addon modules
```

## 🎨 Design system

- Primary `#0071E3` (Apple blue) · Soft `#E8F3FF` · BG `#FFFFFF` / `#F5F5F7` · Text `#1D1D1F`
- Inter / SF Pro Display font stack
- Rounded-2xl cards, glassmorphism sidebar, smooth transitions
- Alpine.js for interactivity (public booking, installer progress)
- Chart.js for analytics
- Tailwind via CDN (no build step)

## 🛡 Reset / re-install

```bash
rm -f storage/installed.lock storage/bookly.sqlite
```

The installer will run again on the next request.

## 📄 License

MIT — built as a self-contained reference implementation.
