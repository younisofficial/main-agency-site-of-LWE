# GrowmioTech — Agency Website (Laravel + Vue 3)

Services, pricing aur contact form wali agency website. Backend Laravel (API + database), frontend Vue 3 + Vue Router + Tailwind CSS.

## 1. Zaroori software

| Software | Version | Check karne ki command |
|----------|---------|------------------------|
| PHP      | 8.2 ya us se upar | `php -v` |
| Composer | 2.x     | `composer -V` |
| Node.js  | 20 ya us se upar | `node -v` |

Windows par sab se asaan tareeqa **Laragon** ya **Laravel Herd** install karna hai — PHP aur Composer dono saath aa jate hain.

## 2. Project chalana (pehli dafa)

Zip extract karein, us folder mein terminal kholein aur yeh commands ek ek kar ke chalayein:

```bash
composer install                 # Laravel ke packages
npm install                      # Vue, Tailwind, Vite
cp .env.example .env             # Windows CMD: copy .env.example .env
php artisan key:generate
php artisan migrate --seed       # tables banata hai + services aur pricing ka data dalta hai
```

`migrate` poochay ke SQLite file banani hai to **yes** kar dein.

Phir **do terminal** kholein:

```bash
php artisan serve                # terminal 1  →  http://localhost:8000
npm run dev                      # terminal 2  →  CSS/JS live reload
```

Browser mein `http://localhost:8000` kholein.

Test chalane ke liye: `php artisan test`

## 3. MySQL use karna ho (optional)

Default SQLite hai, kuch setup nahi chahiye. MySQL ke liye pehle database banayein, phir `.env` mein:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agency
DB_USERNAME=root
DB_PASSWORD=
```

Aur `php artisan migrate:fresh --seed` chala dein.

## 4. Apni cheezein kahan badalni hain

| Kya badalna hai | File |
|-----------------|------|
| Agency ka naam, phone, email, WhatsApp, address, social links | `config/agency.php` |
| Team (naam, role, photo) | `config/agency.php` → `team` |
| Har page ka SEO title aur description | `config/agency.php` → `seo` |
| Hero wali person image | `public/images/hero-person.svg` ko apni photo se replace karein (transparent PNG behtar; phir `resources/js/components/HeroVisual.vue` mein file ka naam badlein) |
| Services ka text, timeline | `database/seeders/DatabaseSeeder.php` → `services()` |
| Pricing plans, dollar prices aur features | `database/seeders/DatabaseSeeder.php` → `plans()` |
| Portfolio ke projects | `database/seeders/DatabaseSeeder.php` → `projects()` (section 8 dekhein) |
| Colours aur fonts ("Warm Paper & Spruce" palette) | `resources/css/app.css` → `@theme` block |
| Pricing ke FAQ | `config/agency.php` → `pricing_faqs` |
| About page ka text | `resources/js/pages/About.vue` |
| Home page | `resources/js/pages/Home.vue` |

Seeder badalne ke baad: `php artisan migrate:fresh --seed`
(yeh purana data, contact messages samait, delete kar deta hai — live site par sirf `php artisan db:seed` chalayein).

> Phone, email, address, dollar prices, team ke naam/photos, portfolio projects aur About ka text **dummy** hain. Live karne se pehle apna asli data dal dein.

## 5. Project ka structure

```
routes/web.php                   Har URL par Vue app load karta hai
routes/api.php                   /api/services, /api/pricing, /api/projects, /api/contact
app/Http/Controllers/Api/        API controllers
app/Http/Requests/               Contact form ki validation
app/Models/                      Service, PricingPlan, Project, ContactMessage
database/migrations/             Tables
database/seeders/                Sara content (services + pricing)

resources/views/app.blade.php    Ek hi HTML page jis mein Vue mount hota hai
resources/js/app.js              Vue start
resources/js/router.js           Pages ke URLs
config/agency.php                Naam, contact, team, FAQs, SEO — sab yahan
app/Http/Controllers/PageController.php   SEO tags, sitemap.xml, robots.txt
resources/js/lib/                site.js, api.js (API calls), seo.js
resources/js/components/         Header, Footer, Estimator, PricingTable, ContactForm…
resources/js/pages/              Home, Services, ServiceDetail, Pricing, About, Contact
```

Pages: `/`, `/services`, `/services/{slug}`, `/portfolio`, `/pricing`, `/about`, `/contact`

## 6. Contact form ke messages dekhna

Messages `contact_messages` table mein save hote hain:

```bash
php artisan tinker
>>> App\Models\ContactMessage::latest()->get();
```

## 7. Nayi service add karna

1. `DatabaseSeeder.php` ke `services()` mein ek naya array add karein (`category`: `development`, `design` ya `marketing`).
2. Naya icon chahiye to `resources/js/components/ServiceIcon.vue` mein key add karein.
3. `php artisan db:seed` chalayein. Service khud hi home, services page, footer, estimator aur contact form mein aa jayegi.

## 8. Portfolio mein apni sites add karna

Abhi 9 **dummy** projects hain (`public/images/portfolio/sample-1.svg` … `sample-9.svg`). Apna kaam dalne ke liye:

1. Site ka screenshot `public/images/portfolio/` mein rakhein, jaise `my-client.jpg` (1200×900 behtareen lagta hai).
2. `database/seeders/DatabaseSeeder.php` ke `projects()` mein dummy entry ko badal dein:

```php
[
    'title' => 'Client ki site ka naam',
    'category' => 'development',          // development | design | marketing
    'client' => 'Client ka naam',
    'summary' => 'Ek line: kya banaya aur kya nateeja nikla.',
    'image' => '/images/portfolio/my-client.jpg',
    'url' => 'https://client-site.com',   // link na ho to null
    'tags' => ['WordPress', 'WooCommerce'],
    'is_featured' => true,                // true = home page par bhi dikhega
],
```

3. `php artisan db:seed` chalayein.

## 9. Purane version se update karna

Agar pehle wala zip chal raha tha to naya zip extract karne ke baad:

```bash
php artisan migrate      # naye tables / columns
php artisan db:seed      # naya data (dollar prices, portfolio)
npm install && npm run dev
```

### Apne purane project folder mein files copy kar rahe hain?

Naye zip ki files purani files ke upar copy karne se **delete hui files reh jati hain**. Yeh khud delete kar dein:

- `public/robots.txt` (zaroori — warna naya `/robots.txt` sitemap ke saath nahi chalega)
- `resources/js/components/Estimator.vue`, `ServiceColumns.vue`, `ServiceRow.vue`

`composer.lock` ko mat chherein. Project Laravel 12 aur 13 dono par chalta hai.

## 10. Live server par lagana

```bash
composer install --no-dev --optimize-autoloader
npm install && npm run build
php artisan migrate --force --seed
php artisan config:cache && php artisan route:cache
```

`.env` mein `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://growmiotech.com`. Domain ka document root `public/` folder hona chahiye.

## 11. Technical SEO — kya laga hua hai

Sab kuch server se HTML mein aata hai, is liye Google aur Facebook/WhatsApp ko JavaScript chalane ki zaroorat nahi:

- Har page ka apna `<title>`, meta description aur canonical URL
- Open Graph + Twitter tags aur share image (`public/images/og-cover.png`)
- Google structured data (JSON-LD): Organization, WebSite, Breadcrumb, har service ka Service, pricing par FAQ
- `/sitemap.xml` (services khud add hoti hain) aur `/robots.txt`
- Ghalat URL par asli **404** status aur `noindex`
- Har page par ek hi `<h1>`, images par `alt`, width/height aur lazy loading
- Favicon, apple-touch-icon, theme colour, `lang="en"`

**Live karne ke baad aap ko yeh karna hai** (yeh code se nahi ho sakta):

1. `.env` mein `APP_URL=https://growmiotech.com` — canonical aur sitemap isi se bante hain.
2. HTTPS (SSL) lagayein aur `www` ko non-www par redirect karein (ya ulta), sirf ek version chale.
3. Google Search Console mein site verify kar ke `https://growmiotech.com/sitemap.xml` submit karein.
4. `config/agency.php` mein asli phone, address aur social links dalein, phir `php artisan config:cache`.
5. PageSpeed Insights (pagespeed.web.dev) par test karein. Asli photos WebP/JPG mein compress kar ke dalein.
