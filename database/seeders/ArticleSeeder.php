<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد دسته‌بندی‌های نمونه (فقط اگر وجود نداشته باشند)
        $categories = [
            'اخبار دبی' => 'اخبار و رویدادهای مهم دبی',
            'سفر و توریسم' => 'راهنمای سفر و جاذبه‌های توریستی دبی',
            'املاک و سرمایه‌گذاری' => 'اخبار بازار املاک و فرصت‌های سرمایه‌گذاری',
            'فرهنگ و هنر' => 'رویدادهای فرهنگی و هنری دبی',
            'تکنولوژی' => 'اخبار تکنولوژی و نوآوری در دبی',
        ];

        foreach ($categories as $name => $description) {
            Category::firstOrCreate(
                ['name' => $name],
                [
                    'slug' => \Illuminate\Support\Str::slug($name),
                    'description' => $description,
                    'is_active' => true,
                    'sort_order' => rand(1, 100),
                ]
            );
        }

        // مقالات نمونه
        $articles = [
            [
                'title' => 'افتتاح برج جدید در دبی مارینا با معماری منحصر به فرد',
                'slug' => 'dubai-marina-tower-opening',
                'excerpt' => 'برج جدید دبی مارینا با ارتفاع 300 متر و معماری منحصر به فرد افتتاح شد. این برج شامل هتل لوکس، آپارتمان‌های مسکونی و مراکز خرید است.',
                'content' => '<p>برج جدید دبی مارینا که یکی از بلندترین و زیباترین ساختمان‌های این منطقه محسوب می‌شود، امروز با حضور مقامات ارشد دبی افتتاح شد.</p><p>این برج با ارتفاع 300 متر و 80 طبقه، شامل هتل 5 ستاره، آپارتمان‌های لوکس مسکونی، مراکز خرید و رستوران‌های بین‌المللی است.</p><p>معماری این برج الهام گرفته از عناصر طبیعی و فرهنگ عربی است و با استفاده از تکنولوژی‌های مدرن ساخته شده است.</p>',
                'category_id' => Category::where('name', 'املاک و سرمایه‌گذاری')->first()->id,
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'is_featured' => true,
                'is_breaking' => false,
                'view_count' => rand(100, 1000),
                'featured_image' => 'articles/dubai-marina-tower.jpg',
            ],
            [
                'title' => 'راهنمای کامل سفر به دبی در سال 2025',
                'slug' => 'dubai-travel-guide-2025',
                'excerpt' => 'راهنمای جامع سفر به دبی شامل بهترین زمان سفر، جاذبه‌های توریستی، هتل‌ها و رستوران‌های معروف برای سال 2025.',
                'content' => '<p>دبی یکی از محبوب‌ترین مقاصد توریستی جهان است که سالانه میلیون‌ها گردشگر را به خود جذب می‌کند.</p><p>در این راهنما، بهترین زمان سفر، جاذبه‌های توریستی معروف مانند برج خلیفه، دبی مال، پالم جمیرا و موارد دیگر را معرفی می‌کنیم.</p><p>همچنین اطلاعات کاملی درباره هتل‌های لوکس، رستوران‌های معروف و حمل و نقل در دبی ارائه می‌دهیم.</p>',
                'category_id' => Category::where('name', 'سفر و توریسم')->first()->id,
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'is_featured' => true,
                'is_breaking' => false,
                'view_count' => rand(100, 1000),
                'featured_image' => 'articles/dubai-travel-guide-2025.jpg',
            ],
            [
                'title' => 'نمایشگاه بین‌المللی هنر معاصر دبی با حضور هنرمندان برجسته',
                'slug' => 'dubai-contemporary-art-exhibition',
                'excerpt' => 'نمایشگاه بین‌المللی هنر معاصر دبی با حضور هنرمندان برجسته از سراسر جهان و نمایش آثار هنری ارزشمند برگزار می‌شود.',
                'content' => '<p>نمایشگاه بین‌المللی هنر معاصر دبی که یکی از مهم‌ترین رویدادهای هنری منطقه خاورمیانه محسوب می‌شود، امروز افتتاح شد.</p><p>در این نمایشگاه، آثار هنری ارزشمند از هنرمندان برجسته جهان به نمایش گذاشته شده است.</p><p>این نمایشگاه شامل نقاشی، مجسمه‌سازی، عکاسی و هنرهای دیجیتال است و تا دو هفته ادامه خواهد داشت.</p>',
                'category_id' => Category::where('name', 'فرهنگ و هنر')->first()->id,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'is_featured' => false,
                'is_breaking' => true,
                'view_count' => rand(100, 1000),
                'featured_image' => 'articles/dubai-art-exhibition.jpg',
            ],
            [
                'title' => 'دبی پیشگام در استفاده از هوش مصنوعی در خدمات شهری',
                'slug' => 'dubai-ai-urban-services',
                'excerpt' => 'دبی با استفاده از تکنولوژی هوش مصنوعی، خدمات شهری خود را به سطح جدیدی ارتقا داده و به عنوان شهر هوشمند نمونه معرفی شده است.',
                'content' => '<p>دبی با سرمایه‌گذاری در تکنولوژی هوش مصنوعی، خدمات شهری خود را به سطح جدیدی ارتقا داده است.</p><p>استفاده از هوش مصنوعی در مدیریت ترافیک، خدمات پلیس، بهداشت و درمان و آموزش، دبی را به عنوان شهر هوشمند نمونه معرفی کرده است.</p><p>این تکنولوژی‌ها باعث بهبود کیفیت زندگی شهروندان و افزایش کارایی خدمات شهری شده است.</p>',
                'category_id' => Category::where('name', 'تکنولوژی')->first()->id,
                'status' => 'published',
                'published_at' => now()->subDays(4),
                'is_featured' => false,
                'is_breaking' => false,
                'view_count' => rand(100, 1000),
                'featured_image' => 'articles/dubai-largest-mall.jpg',
            ],
            [
                'title' => 'افتتاح بزرگترین مرکز خرید خاورمیانه در دبی',
                'slug' => 'dubai-largest-mall-opening',
                'excerpt' => 'بزرگترین مرکز خرید خاورمیانه با مساحت 500 هزار متر مربع و بیش از 1000 فروشگاه در دبی افتتاح شد.',
                'content' => '<p>بزرگترین مرکز خرید خاورمیانه که در قلب دبی ساخته شده، امروز با حضور هزاران نفر افتتاح شد.</p><p>این مرکز خرید با مساحت 500 هزار متر مربع، شامل بیش از 1000 فروشگاه، رستوران‌های بین‌المللی، سینما و مراکز تفریحی است.</p><p>طراحی این مرکز خرید الهام گرفته از معماری اسلامی و مدرن است و تجربه خرید منحصر به فردی را برای بازدیدکنندگان فراهم می‌کند.</p>',
                'category_id' => Category::where('name', 'اخبار دبی')->first()->id,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'is_featured' => true,
                'is_breaking' => false,
                'view_count' => rand(100, 1000),
                'featured_image' => 'articles/dubai-largest-mall.jpg',
            ],
        ];

        foreach ($articles as $articleData) {
            Article::firstOrCreate(
                ['slug' => $articleData['slug']],
                $articleData
            );
        }
    }
}
