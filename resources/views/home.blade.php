@extends('layouts.app')

@section('title', 'صفحه اصلی')
@section('description', 'مرجع کامل اطلاعات زندگی، سفر و کسب‌وکار در دبی')

@section('content')
<!-- Breaking News Ticker -->
<div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-3 relative overflow-hidden" x-data="{ isVisible: true }" x-show="isVisible">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="bg-red-800 text-white px-3 py-1 text-xs font-bold rounded-full animate-pulse">🔥 خبر فوری</span>
            <div class="marquee-container overflow-hidden">
                <div class="marquee-content animate-marquee whitespace-nowrap">
                    <span class="ml-8">آخرین اخبار و رویدادهای دبی را از دست ندهید! </span>
                    <span class="ml-8">بروزرسانی لحظه‌ای اطلاعات سفر و کسب‌وکار در دبی</span>
                    <span class="ml-8">مرجع معتبر اطلاعات زندگی در دبی</span>
                </div>
            </div>
        </div>
        <button @click="isVisible = false" class="text-white hover:text-red-200 transition-colors duration-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white py-16 overflow-hidden hero-section">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <!-- Hero Slider -->
    @if($heroSliderArticles && $heroSliderArticles->count() > 0)
    <div class="absolute inset-0" x-data="{ currentSlide: 0, totalSlides: {{ $heroSliderArticles->count() }} }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % totalSlides }, 5000)">
        @foreach($heroSliderArticles as $index => $article)
        <div class="absolute inset-0 transition-opacity duration-1000"
             x-show="currentSlide === {{ $index }}"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-1000"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <img src="{{ Storage::url($article->featured_image) }}"
                 alt="{{ $article->title }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 via-blue-800/30 to-indigo-900/40"></div>
        </div>
        @endforeach

        <!-- Slider Navigation Dots -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 space-x-reverse">
            @foreach($heroSliderArticles as $index => $article)
            <button @click="currentSlide = {{ $index }}"
                    class="w-2 h-2 rounded-full transition-all duration-300"
                    :class="currentSlide === {{ $index }} ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75'">
            </button>
            @endforeach
        </div>

        <!-- Slider Navigation Arrows -->
        <button @click="currentSlide = (currentSlide - 1 + totalSlides) % totalSlides"
                class="absolute left-6 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-2 rounded-full backdrop-blur-sm transition-all duration-300 hover:scale-110">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="currentSlide = (currentSlide + 1) % totalSlides"
                class="absolute right-6 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-2 rounded-full backdrop-blur-sm transition-all duration-300 hover:scale-110">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Current Article Info Overlay -->
        @foreach($heroSliderArticles as $index => $article)
        <div class="absolute bottom-20 left-6 right-6 transition-all duration-1000"
             x-show="currentSlide === {{ $index }}"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 transform translate-y-8"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-1000"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-8">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                <div class="flex items-center gap-3 mb-3">
                    <span class="badge-category px-3 py-1 text-xs rounded-full">
                        {{ $article->category->name ?? 'عمومی' }}
                    </span>
                    @if($article->is_breaking)
                    <span class="bg-red-600 text-white px-2 py-1 text-xs font-bold rounded-full animate-pulse">
                        🔥 خبر فوری
                    </span>
                    @endif
                    @if($article->is_featured)
                    <span class="bg-yellow-500 text-white px-2 py-1 text-xs font-bold rounded-full">
                        ⭐ ویژه
                    </span>
                    @endif
                </div>
                <h3 class="text-lg md:text-xl font-black mb-2 leading-tight">
                    <a href="{{ route('articles.show', $article) }}" class="hover:text-blue-200 transition-colors duration-300">
                        {{ Str::limit($article->title, 60) }}
                    </a>
                </h3>
                @if($article->excerpt)
                <p class="text-blue-100 text-sm leading-relaxed mb-3">
                    {{ Str::limit($article->excerpt, 80) }}
                </p>
                @endif
                <div class="flex items-center gap-3 text-xs text-blue-200">
                    <span class="flex items-center">
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $article->published_at ? $article->published_at->format('Y/m/d') : 'بدون تاریخ' }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ $article->view_count ?? 0 }} بازدید
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <!-- محتوای overlay حذف شده اما ارتفاع حفظ شده -->
        </div>
    </div>
</div>

<!-- News by Categories -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($categories && $categories->count() > 0)
        @foreach($categories as $category)
            @if(isset($articlesByCategory[$category->id]) && $articlesByCategory[$category->id]->count() > 0)
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl md:text-3xl font-black text-gray-900">{{ $category->name }}</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-green-500 rounded-full"></div>
                        <span class="bg-blue-100 text-blue-600 px-3 py-1 text-sm font-bold rounded-full">{{ $articlesByCategory[$category->id]->count() }} مقاله</span>
                    </div>
                    <a href="{{ route('categories.show', $category) }}" class="text-blue-600 hover:text-blue-800 font-bold transition-colors duration-300 group">
                        مشاهده همه
                        <svg class="w-4 h-4 mr-1 inline group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($articlesByCategory[$category->id] as $article)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 border-t-4 border-t-blue-500">
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($article->featured_image) }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-40 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-2 right-2">
                                @if($article->is_breaking)
                                <span class="bg-red-600 text-white px-2 py-1 text-xs font-bold rounded-full animate-pulse">🔥</span>
                                @endif
                                @if($article->is_featured)
                                <span class="bg-yellow-500 text-white px-2 py-1 text-xs font-bold rounded-full">⭐</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-base font-bold text-gray-900 mb-2 leading-tight line-clamp-2">
                                <a href="{{ route('articles.show', $article) }}" class="hover:text-blue-600 transition-colors duration-300">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            @if($article->excerpt)
                            <p class="text-gray-600 text-sm leading-relaxed mb-3 line-clamp-2">
                                {{ $article->excerpt }}
                            </p>
                            @endif
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $article->published_at ? $article->published_at->format('Y/m/d') : 'بدون تاریخ' }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $article->view_count ?? 0 }}
                                </span>
                            </div>
                            <a href="{{ route('articles.show', $article) }}"
                               class="inline-flex items-center justify-center w-full bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition-colors duration-300">
                                ادامه مطلب
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    @endif
</div>

<!-- Sidebar -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Categories -->
        @if($categories && $categories->count() > 0)
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-t-blue-500">
                <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 ml-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    دسته‌بندی‌ها
                </h3>
                <div class="space-y-3">
                    @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}"
                         class="flex items-center justify-between p-3 rounded-xl hover:bg-blue-50 transition-all duration-300 group">
                        <span class="text-gray-700 group-hover:text-blue-600 font-medium">{{ $category->name }}</span>
                        <span class="bg-blue-100 text-blue-600 text-xs font-bold px-2 py-1 rounded-full">{{ $category->articles_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Weather Widget -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-t-green-500">
                <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 ml-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                    </svg>
                    آب و هوای دبی
                </h3>
                <div class="text-center">
                    <div class="text-4xl font-black text-gray-900 mb-2">32°C</div>
                    <div class="text-gray-600 text-sm mb-4">آفتابی و گرم</div>
                    <div class="flex justify-center space-x-4 space-x-reverse text-sm text-gray-500">
                        <div>
                            <div class="font-bold">رطوبت</div>
                            <div>45%</div>
                        </div>
                        <div>
                            <div class="font-bold">باد</div>
                            <div>12 km/h</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="lg:col-span-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-t-yellow-500">
                    <h3 class="text-lg font-black text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 ml-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        آمار کلی
                    </h3>
                    <div class="space-y-3">
                        @php
                            $totalArticles = 0;
                            if($categories) {
                                foreach($categories as $category) {
                                    if(isset($articlesByCategory[$category->id])) {
                                        $totalArticles += $articlesByCategory[$category->id]->count();
                                    }
                                }
                            }
                        @endphp
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">کل مقالات</span>
                            <span class="text-2xl font-black text-blue-600">{{ $totalArticles }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">دسته‌بندی‌ها</span>
                            <span class="text-2xl font-black text-green-600">{{ $categories ? $categories->count() : 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">بازدید کل</span>
                            @php
                                $totalViews = 0;
                                if($categories) {
                                    foreach($categories as $category) {
                                        if(isset($articlesByCategory[$category->id])) {
                                            $totalViews += $articlesByCategory[$category->id]->sum('view_count');
                                        }
                                    }
                                }
                            @endphp
                            <span class="text-2xl font-black text-yellow-600">{{ $totalViews }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl p-6 border-t-4 border-t-purple-500">
                    <h3 class="text-lg font-black text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 ml-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        آخرین بروزرسانی
                    </h3>
                    <div class="space-y-3">
                        @php
                            $latestArticle = null;
                            if($categories) {
                                foreach($categories as $category) {
                                    if(isset($articlesByCategory[$category->id]) && $articlesByCategory[$category->id]->count() > 0) {
                                        $latestArticle = $articlesByCategory[$category->id]->first();
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 text-sm">آخرین مقاله</span>
                            <span class="text-xs text-gray-500">{{ $latestArticle && $latestArticle->published_at ? $latestArticle->published_at->diffForHumans() : 'نامشخص' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 text-sm">مقالات امروز</span>
                            @php
                                $todayArticles = 0;
                                if($categories) {
                                    foreach($categories as $category) {
                                        if(isset($articlesByCategory[$category->id])) {
                                            $todayArticles += $articlesByCategory[$category->id]->where('published_at', '>=', now()->startOfDay())->count();
                                        }
                                    }
                                }
                            @endphp
                            <span class="text-xs text-gray-500">{{ $todayArticles }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 text-sm">مقالات این هفته</span>
                            @php
                                $weekArticles = 0;
                                if($categories) {
                                    foreach($categories as $category) {
                                        if(isset($articlesByCategory[$category->id])) {
                                            $weekArticles += $articlesByCategory[$category->id]->where('published_at', '>=', now()->startOfWeek())->count();
                                        }
                                    }
                                }
                            @endphp
                            <span class="text-xs text-gray-500">{{ $weekArticles }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
