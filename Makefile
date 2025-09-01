.PHONY: help install setup dev build test clean docker-up docker-down

help: ## نمایش راهنما
	@echo "دستورات موجود:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

install: ## نصب وابستگی‌ها
	composer install
	npm install

setup: ## راه‌اندازی اولیه پروژه
	cp .env.example .env
	php artisan key:generate
	php artisan migrate
	php artisan storage:link
	npm run build
	@echo "✅ پروژه با موفقیت راه‌اندازی شد!"

dev: ## اجرای محیط توسعه
	@echo "🚀 اجرای محیط توسعه..."
	@echo "📱 وبسایت: http://localhost:8000"
	@echo "🔧 پنل ادمین: http://localhost:8000/admin"
	php artisan serve

build: ## ساخت فایل‌های production
	npm run build

test: ## اجرای تست‌ها
	php artisan test

clean: ## پاک کردن فایل‌های موقت
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	rm -rf public/build

docker-up: ## اجرای Docker containers
	docker-compose up -d

docker-down: ## توقف Docker containers
	docker-compose down

docker-build: ## ساخت Docker image
	docker-compose build

docker-logs: ## نمایش لاگ‌های Docker
	docker-compose logs -f

fresh: ## ریست کامل پروژه
	php artisan migrate:fresh --seed
	npm run build

optimize: ## بهینه‌سازی برای production
	php artisan config:cache
	php artisan route:cache
	php artisan view:cache
	npm run build

backup: ## پشتیبان‌گیری از دیتابیس
	php artisan db:backup

seed: ## پر کردن دیتابیس با داده‌های نمونه
	php artisan db:seed

user: ## ایجاد کاربر ادمین جدید
	php artisan make:filament-user
