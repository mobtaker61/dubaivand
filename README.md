# DubaiVand - مرجع کامل اطلاعات دبی

![DubaiVand Logo](https://img.shields.io/badge/DubaiVand-مرجع%20کامل%20اطلاعات%20دبی-blue?style=for-the-badge&logo=dubai)

مرجع کامل و معتبر اطلاعات زندگی، سفر و کسب‌وکار در دبی با طراحی مدرن و روزنامه‌ای.

## ✨ ویژگی‌های جدید - طراحی روزنامه‌ای

### 🎨 رابط کاربری بهبود یافته
- **Breaking News Bar**: نوار اخبار فوری با انیمیشن marquee
- **Header مدرن**: شامل تاریخ، آب و هوا و جستجوی پیشرفته
- **Typography روزنامه‌ای**: استفاده از فونت‌های ضخیم و سلسله مراتب بصری
- **رنگ‌بندی حرفه‌ای**: ترکیب آبی، قرمز و خاکستری برای حس روزنامه

### 📰 طراحی صفحات
- **صفحه اصلی**: Hero section جذاب با خبر اصلی و sidebar
- **صفحه مقالات**: فیلترهای پیشرفته و کارت‌های روزنامه‌ای
- **صفحه مقاله**: طراحی خوانا با breadcrumb و آمار
- **Sidebar**: دسته‌بندی‌ها، برچسب‌ها و خبرنامه

### 🎭 انیمیشن‌ها و تعامل
- **Marquee Animation**: برای اخبار فوری
- **Hover Effects**: افکت‌های تعاملی برای کارت‌ها
- **Pulse Animation**: برای اخبار فوری
- **Smooth Transitions**: انتقال‌های نرم بین صفحات

## 🚀 تکنولوژی‌ها

- **Backend**: Laravel 12
- **Frontend**: TALL Stack (Tailwind CSS, Alpine.js, Livewire)
- **Admin Panel**: Filament 3.3
- **Database**: MySQL/PostgreSQL
- **Font**: Vazirmatn (فونت فارسی)
- **Icons**: Heroicons

## 📋 پیش‌نیازها

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+ یا PostgreSQL 13+

## 🛠️ نصب و راه‌اندازی

### 1. کلون کردن پروژه
```bash
git clone https://github.com/your-username/dubaivand.git
cd dubaivand
```

### 2. نصب وابستگی‌ها
```bash
composer install
npm install
```

### 3. پیکربندی محیط
```bash
cp .env.example .env
php artisan key:generate
```

### 4. تنظیمات پایگاه داده
```bash
php artisan migrate
php artisan db:seed
```

### 5. ساخت فایل‌های فرانت‌اند
```bash
npm run build
```

### 6. ایجاد کاربر ادمین
```bash
php artisan make:filament-user
```

### 7. اجرای پروژه
```bash
php artisan serve
```

## 🎨 ویژگی‌های طراحی

### رنگ‌بندی
- **آبی اصلی**: `#1e40af` - برای عناصر اصلی
- **قرمز اخبار**: `#dc2626` - برای اخبار فوری
- **خاکستری**: `#6b7280` - برای متن‌های ثانویه

### Typography
- **عنوان اصلی**: `font-black` (900 weight)
- **عنوان فرعی**: `font-bold` (700 weight)
- **متن معمولی**: `font-medium` (500 weight)

### انیمیشن‌ها
- **Marquee**: برای اخبار فوری
- **Pulse**: برای اخبار فوری
- **Hover Lift**: برای کارت‌ها
- **Smooth Transitions**: برای تمام تعاملات

## 📱 صفحات اصلی

### 1. صفحه اصلی (`/`)
- Breaking News Bar
- Hero Section با جستجو
- خبر اصلی
- آخرین اخبار
- اخبار پربازدید
- Sidebar با دسته‌بندی‌ها

### 2. صفحه مقالات (`/articles`)
- فیلترهای پیشرفته
- جستجوی زنده
- کارت‌های روزنامه‌ای
- Pagination
- Sidebar با برچسب‌ها

### 3. صفحه مقاله (`/articles/{id}`)
- Breadcrumb
- محتوای کامل
- مقالات مرتبط
- آمار مقاله
- اشتراک‌گذاری

## 🎯 ویژگی‌های کلیدی

### مدیریت محتوا
- ✅ مدیریت مقالات با Filament
- ✅ مدیریت دسته‌بندی‌ها
- ✅ آپلود تصاویر
- ✅ SEO optimization
- ✅ مدیریت وضعیت انتشار

### رابط کاربری
- ✅ طراحی RTL کامل
- ✅ Responsive Design
- ✅ انیمیشن‌های مدرن
- ✅ Accessibility
- ✅ Performance Optimization

### SEO و بهینه‌سازی
- ✅ Meta tags پویا
- ✅ Open Graph
- ✅ Structured Data
- ✅ Sitemap
- ✅ Robots.txt

## 🔧 توسعه

### ساخت فایل‌های توسعه
```bash
npm run dev
```

### تست
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

## 📊 ساختار پروژه

```
dubaivand/
├── app/
│   ├── Filament/          # پنل مدیریت
│   ├── Http/Controllers/  # کنترلرها
│   └── Models/           # مدل‌ها
├── database/
│   ├── migrations/       # migration ها
│   └── seeders/         # seeder ها
├── resources/
│   ├── css/             # استایل‌ها
│   ├── js/              # جاوااسکریپت
│   └── views/           # قالب‌ها
└── routes/
    └── web.php          # مسیرها
```

## 🤝 مشارکت

برای مشارکت در پروژه:

1. Fork کنید
2. Branch جدید ایجاد کنید (`git checkout -b feature/amazing-feature`)
3. تغییرات را commit کنید (`git commit -m 'Add amazing feature'`)
4. Push کنید (`git push origin feature/amazing-feature`)
5. Pull Request ایجاد کنید

## 📄 لایسنس

این پروژه تحت لایسنس MIT منتشر شده است. برای اطلاعات بیشتر فایل [LICENSE](LICENSE) را مطالعه کنید.

## 📞 تماس

- **وب‌سایت**: [dubaivand.com](https://dubaivand.com)
- **ایمیل**: info@dubaivand.com
- **توییتر**: [@dubaivand](https://twitter.com/dubaivand)

## 🙏 تشکر

از تمامی افرادی که در توسعه این پروژه مشارکت داشته‌اند، تشکر می‌کنیم.

---

**DubaiVand** - مرجع کامل اطلاعات دبی 🇦🇪
