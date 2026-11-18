# মাহমুদ সাপোর্ট / Hojifa — পার্সোনাল এজেন্সি পোর্টফোলিও (Laravel)

`https://home.mahmudsupport.xyz/` ডোমেইনের জন্য তৈরি সম্পূর্ণ Laravel 12 ওয়েবসাইট।
ফিচার: সার্ভিস, রেসপন্সিবিলিটি, স্কিল, পোর্টফোলিও (ক্যাটাগরি অনুযায়ী), ব্লগ, সার্টিফিকেট,
টিম + টাস্ক ড্যাশবোর্ড, ফ্রি কনসালটেন্সি লিড ফর্ম, লাইভ চ্যাট, AI মার্কেটিং অ্যাসিস্ট্যান্ট,
ইমেইল পপআপ কালেক্টর (অফ/পপআপ/গেট), ক্লায়েন্ট ড্যাশবোর্ড (প্রজেক্ট + ইনভয়েস + পেমেন্ট),
বিকাশ/নগদ/ইন্টারন্যাশনাল পেমেন্ট ভাউচার ফ্লো, মেম্বার রেজিস্ট্রেশন (অ্যাডমিন অ্যাপ্রুভাল),
সম্পূর্ণ বাংলা/ইংরেজি ভাষা টগল — সবকিছু অ্যাডমিন প্যানেল থেকে অ্যাড/রিমুভ/কাস্টমাইজযোগ্য।

## ✅ রেডি-টু-ডিপ্লয় (আগে থেকেই সম্পন্ন)

- **`vendor/` ডিরেক্টরি অন্তর্ভুক্ত** — হোস্টিংয়ে `composer install` চালাতে হবে না।
- **`public/build/` বিল্ড করা CSS/JS** — `npm run build` চালাতে হবে না।
- **`deploy/public_html/index.php`** — পাথ আগে থেকেই `laravel_app/` কাঠামোয় ঠিক করা।
- **`deploy/install.sql`** — phpMyAdmin-এ ইমপোর্ট করলেই ২২টি টেবিল + অ্যাডমিন ইউজার + ডেমো কন্টেন্ট প্রস্তুত।
- **`deploy/env.cpanel`** — প্রোডাকশন-রেডি `.env` টেমপ্লেট।

## 🚀 cPanel ডেপ্লয় চেকলিস্ট (৮ ধাপ)

1. **PHP ভার্সন** — cPanel → *Select PHP Version* / MultiPHP Manager → **PHP 8.2+** সিলেক্ট করুন।
   এক্সটেনশন: `mbstring`, `pdo_mysql`, `openssl`, `xml`, `ctype`, `fileinfo`, `curl`, `gd` (ছবি আপলোডের জন্য)।
2. **ডাটাবেস** — cPanel → *MySQL Databases* → নতুন ডিবি + ইউজার বানান, **All Privileges** দিন।
3. **SQL ইমপোর্ট** — cPanel → *phpMyAdmin* → ডিবি সিলেক্ট → Import → **`deploy/install.sql`** আপলোড করুন।
4. **ফাইল আপলোড** — রিপোজিটরির **ZIP ডাউনলোড** করে আপলোড করুন। স্ট্রাকচার:

   ```
   /home/username/
   ├── laravel_app/      ← public ছাড়া প্রজেক্টের সব ফাইল: app, bootstrap, config, database,
   │                       lang, resources, routes, storage, vendor, public/build,
   │                       artisan, composer.json, composer.lock, .env
   └── public_html/      ← deploy/public_html/ এর index.php + .htaccess,
                          এবং public/build/ এর ভেতরের assets/ + manifest.json
   ```

5. **`.env` সেট করুন** — `deploy/env.cpanel` কে `laravel_app/.env` নামে রাখুন এবং
   `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `APP_URL` আপনার cPanel ভ্যালু দিয়ে বদলান।
6. **পারমিশন** — `laravel_app/storage` এবং `laravel_app/bootstrap/cache` এ **755** পারমিশন দিন (দরকারে 775)।
7. **স্টোরেজ লিংক** — cPanel Terminal থাকলে:
   ```bash
   ln -s /home/username/laravel_app/storage/app/public /home/username/public_html/storage
   ```
   Terminal না থাকলে File Manager থেকে `storage/app/public/uploads` এর ছবিগুলো সাইটের পাথে রাখুন।
8. **টেস্ট** — সাইট ভিজিট করুন: হোম পেজ এবং `/admin/login` — দুটোই চলা উচিত।

## 🌐 লগইন ও রাউট

| প্যানেল | URL | ইউজার |
|---|---|---|
| অ্যাডমিন | `/admin/login` | `admin@mahmudsupport.xyz` / `Admin@12345` (সিড ডিফল্ট) |
| ক্লায়েন্ট | `/login` | `/register` থেকে অ্যাকাউন্ট খুলে |
| টিম (মেম্বার) | `/login` | `/membership` থেকে আবেদন → অ্যাডমিন অ্যাপ্রুভাল |

> ⚠️ ডেপ্লয়ের পর সবার প্রথম কাজ: অ্যাডমিন প্যানেলে ঢুকে ডিফল্ট পাসওয়ার্ড বদলান।

অন্যান্য রাউট: `/services`, `/about`, `/contact`, `/request-custom-work` (কাস্টম কাজের
রিকোয়ারমেন্ট), `/portfolio`, `/blog`, `/sitemap.xml`, `/lang/en`–`/lang/bn` (ভাষা টগল)।

## 🎛️ ব্যাকএন্ড (অ্যাডমিন প্যানেল)

২৩টি মডিউল: Dashboard, Settings (৮ গ্রুপ: ব্র্যান্ড/হিরো/কনটাক্ট/পপআপ/পেমেন্ট/AI/SEO/ফুটার),
Leads, Visitors, Users, Live Chats, Tasks, Client Projects, Invoices, Payments (অ্যাপ্রুভ/রিজেক্ট),
Services, Skills, Responsibilities, Projects (মাল্টি-ইমেজ + before/after), Portfolio Categories,
Team Members, Certificates, Testimonials, FAQs, Stats, Blog, Pages।

- পপআপ মোড: Settings → Popup → `off | popup | gate`
- পেমেন্ট নম্বর: Settings → Payment → বিকাশ/নগদ নম্বর বসালেই ক্লায়েন্ট পেমেন্ট করতে পারবে
- AI অ্যাসিস্ট্যান্ট: Settings → AI → চালু + API কী দিলে লাইভ উত্তর দেবে, না দিলে ফলব্যাক উত্তর

## 🧩 টেকনোলজি

- Laravel 12, Blade, Tailwind CSS 4 + Vite (বিল্ড করা অ্যাসেট অন্তর্ভুক্ত)
- দ্বিভাষিক (বাংলা ডিফল্ট) — প্রতিটি কনটেন্টের `*_bn` ও `*_en` ফিল্ড
- SQLite লোকাল ডেভ, MySQL প্রোডাকশন
- পেমেন্ট: ভাউচার + WhatsApp কনফার্মেশন (গেটওয়ে-রেডি আর্কিটেকচার)

## 🛠️ লোকাল ডেভেলপমেন্ট (ঐচ্ছিক)

```bash
composer install
cp .env.example .env && php artisan key:generate
touch database/database.sqlite && php artisan migrate --seed
npm install && npm run build
php artisan serve
```

## 📌 সাধারণ সমস্যা

| সমস্যা | সমাধান |
|---|---|
| 500 এরর | `.env` ভ্যালু যাচাই, `storage/` ও `bootstrap/cache/` এ 755 পারমিশন |
| সাদা পেজ | PHP 8.2+ সিলেক্ট করা আছে কি না দেখুন |
| CSS/JS লোড হচ্ছে না | `public_html/build/` এ `assets/` + `manifest.json` কপি হয়েছে কি না, `APP_URL` ঠিক আছে কি না |
| ডাটাবেস কানেকশন এরর | `DB_*` ভ্যালু cPanel ডিবির নাম/ইউজারের সাথে মিলছে কি না |
| 404 (হোম ছাড়া পেজে) | `public_html/.htaccess` ফাইল আছে কি না চেক করুন |
| ছবি দেখা যাচ্ছে না | ধাপ ৭-এর স্টোরেজ লিংক করা হয়েছে কি না দেখুন |
