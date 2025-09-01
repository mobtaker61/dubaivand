# Security Policy

## Supported Versions

| Version | Supported          |
| ------- | ------------------ |
| 1.0.x   | :white_check_mark: |
| < 1.0   | :x:                |

## Reporting a Vulnerability

اگر یک مشکل امنیتی در DubaiVand پیدا کردید، لطفاً آن را به صورت خصوصی گزارش دهید.

### نحوه گزارش مشکل امنیتی

1. **ایجاد Issue خصوصی**
   - به بخش Issues بروید
   - روی "New Issue" کلیک کنید
   - عنوان را با `[SECURITY]` شروع کنید
   - Issue را به صورت private تنظیم کنید

2. **اطلاعات مورد نیاز**
   - توضیح کامل مشکل
   - مراحل تکرار مشکل
   - تأثیر احتمالی
   - پیشنهادات برای رفع مشکل

3. **مثال گزارش**
```
Title: [SECURITY] SQL Injection in search functionality

Description:
در تابع جستجو در ArticleController، ورودی کاربر به درستی sanitize نمی‌شود.

Steps to reproduce:
1. به صفحه جستجو بروید
2. عبارت زیر را وارد کنید: ' OR 1=1 --
3. جستجو کنید

Impact:
مهاجم می‌تواند به تمام داده‌های دیتابیس دسترسی پیدا کند.

Suggested fix:
استفاده از prepared statements یا validation مناسب
```

### پاسخ‌گویی

- **زمان پاسخ**: حداکثر 48 ساعت
- **زمان رفع**: بسته به شدت مشکل، 1-7 روز
- **اعلان عمومی**: پس از رفع مشکل

### تشکر

از گزارش مشکلات امنیتی شما سپاسگزاریم. این کار به بهبود امنیت DubaiVand کمک می‌کند.

---

**ایمیل امنیتی**: security@dubaivand.com 
