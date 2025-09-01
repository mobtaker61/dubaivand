# راهنمای مشارکت در DubaiVand

از مشارکت شما در پروژه DubaiVand سپاسگزاریم! این فایل راهنمای کاملی برای مشارکت در پروژه است.

## 🚀 شروع کار

### پیش‌نیازها
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL/MariaDB
- Git

### راه‌اندازی محیط توسعه

1. **Fork کردن پروژه**
```bash
# Fork کنید و سپس clone کنید
git clone https://github.com/YOUR_USERNAME/DubaiVand.git
cd DubaiVand
```

2. **نصب وابستگی‌ها**
```bash
composer install
npm install
```

3. **پیکربندی محیط**
```bash
cp .env.example .env
php artisan key:generate
```

4. **پیکربندی پایگاه داده**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dubaivand_dev
DB_USERNAME=root
DB_PASSWORD=
```

5. **اجرای migration ها**
```bash
php artisan migrate
php artisan storage:link
```

6. **ساخت assets**
```bash
npm run build
```

## 📝 نحوه مشارکت

### 1. ایجاد Issue
قبل از شروع کار، یک Issue ایجاد کنید و توضیح دهید که چه کاری می‌خواهید انجام دهید.

### 2. ایجاد Branch
```bash
git checkout -b feature/your-feature-name
# یا
git checkout -b fix/your-bug-fix
```

### 3. کدنویسی
- از استانداردهای PSR-12 پیروی کنید
- کدهای تمیز و قابل خواندن بنویسید
- کامنت‌های مناسب اضافه کنید
- تست‌های مناسب بنویسید

### 4. Commit کردن
```bash
git add .
git commit -m "feat: اضافه کردن ویژگی جدید"
git commit -m "fix: رفع باگ در سیستم جستجو"
git commit -m "docs: به‌روزرسانی مستندات"
```

### 5. Push کردن
```bash
git push origin feature/your-feature-name
```

### 6. ایجاد Pull Request
- توضیح کامل تغییرات
- لینک به Issue مربوطه
- اسکرین‌شات (در صورت نیاز)

## 🎨 استانداردهای کدنویسی

### PHP (Laravel)
```php
<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * نمایش لیست مقالات
     */
    public function index(Request $request)
    {
        $articles = Article::published()
            ->with('category')
            ->latest()
            ->paginate(12);

        return view('articles.index', compact('articles'));
    }
}
```

### JavaScript
```javascript
// استفاده از Alpine.js
document.addEventListener('alpine:init', () => {
    Alpine.data('searchComponent', () => ({
        query: '',
        results: [],
        
        async search() {
            // کد جستجو
        }
    }));
});
```

### CSS (Tailwind)
```html
<!-- استفاده از کلاس‌های Tailwind -->
<div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">عنوان</h2>
    <p class="text-gray-600 leading-relaxed">متن محتوا</p>
</div>
```

## 🧪 تست‌نویسی

### PHP Tests
```php
<?php

namespace Tests\Feature;

use App\Models\Article;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function test_can_view_articles_list()
    {
        $response = $this->get('/articles');
        
        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
    }
}
```

### JavaScript Tests
```javascript
// تست‌های Alpine.js
describe('Search Component', () => {
    it('should filter results based on query', () => {
        // کد تست
    });
});
```

## 📚 مستندات

### کد کامنت‌ها
```php
/**
 * افزایش تعداد بازدید مقاله
 * 
 * @return void
 */
public function incrementViewCount(): void
{
    $this->increment('view_count');
}
```

### README فایل‌ها
هر فایل جدید باید دارای کامنت‌های مناسب باشد.

## 🔍 بررسی کد

### قبل از ارسال PR
- [ ] کدها تست شده‌اند
- [ ] مستندات به‌روزرسانی شده
- [ ] استانداردهای کدنویسی رعایت شده
- [ ] فایل‌های اضافی حذف شده‌اند

### Code Review
- بررسی عملکرد کد
- بررسی امنیت
- بررسی بهینه‌سازی
- بررسی قابلیت نگهداری

## 🐛 گزارش باگ

### اطلاعات مورد نیاز
- نسخه PHP
- نسخه Laravel
- مرورگر (در صورت نیاز)
- سیستم عامل
- توضیح کامل مشکل
- مراحل تکرار مشکل
- اسکرین‌شات (در صورت نیاز)

## 💡 پیشنهادات

### ویژگی‌های جدید
- توضیح کامل ویژگی
- مزایای آن
- پیچیدگی پیاده‌سازی
- نمونه‌های مشابه

## 📞 ارتباط

- **ایمیل**: info@dubaivand.com
- **GitHub Issues**: برای گزارش باگ و پیشنهادات
- **Discussions**: برای سوالات و بحث‌ها

## 🏆 تشکر

از مشارکت شما در بهبود DubaiVand سپاسگزاریم! هر مشارکت، هرچند کوچک، ارزشمند است.

---

**با ❤️ برای جامعه فارسی‌زبان** 
