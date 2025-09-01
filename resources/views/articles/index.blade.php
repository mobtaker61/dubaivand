@extends('layouts.app')

@section('title', 'اخبار و مقالات')
@section('description', 'آخرین اخبار و مقالات درباره زندگی، سفر و کسب‌وکار در دبی')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-900 to-indigo-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-black mb-6 text-shadow-newspaper-lg">
                اخبار و مقالات
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                آخرین اخبار و اطلاعات به‌روز درباره زندگی، سفر و کسب‌وکار در دبی
            </p>
        </div>
    </div>
</div>

<!-- Search and Filters -->
<div class="bg-white shadow-lg border-b-4 border-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ route('articles.index') }}" method="GET" class="space-y-6">
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="جستجو در اخبار و مقالات..."
                           class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent focus-newspaper">
                    <button type="submit" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('articles.index') }}"
                   class="px-4 py-2 rounded-full font-bold transition-colors {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    همه
                </a>
                @foreach($categories as $category)
                <a href="{{ route('articles.index', ['category' => $category->slug]) }}"
                   class="px-4 py-2 rounded-full font-bold transition-colors {{ request('category') == $category->slug ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $category->name }}
                    <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full mr-1">{{ $category->articles_count }}</span>
                </a>
                @endforeach
            </div>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Articles Grid -->
        <div class="lg:col-span-3">
            @if($articles->count() > 0)
                <!-- Results Info -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-black text-gray-900">نتایج جستجو</h2>
                        <div class="w-12 h-1 bg-red-600 mr-4"></div>
                        <span class="text-gray-600">{{ $articles->total() }} مقاله یافت شد</span>
                    </div>
                    @if(request('search') || request('category'))
                    <a href="{{ route('articles.index') }}" class="text-blue-600 hover:text-blue-700 font-bold">
                        پاک کردن فیلترها
                    </a>
                    @endif
                </div>

                <!-- Articles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($articles as $article)
                    <article class="bg-white rounded-lg shadow-newspaper-lg overflow-hidden hover-lift border-l-4 border-blue-600">
                        @if($article->featured_image)
                        <div class="relative">
                            <img src="{{ Storage::url($article->featured_image) }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="badge-category px-3 py-1 text-sm rounded-full">
                                    {{ $article->category->name }}
                                </span>
                            </div>
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center gap-4 mb-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $article->published_at->format('Y/m/d') }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $article->view_count }} بازدید
                                </span>
                            </div>
                            <h3 class="text-xl font-black text-gray-900 mb-4 leading-tight">
                                <a href="{{ route('articles.show', $article) }}" class="hover:text-blue-600 transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            @if($article->excerpt)
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($article->excerpt, 150) }}</p>
                            @endif
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    @if($article->is_featured)
                                    <span class="badge-news px-2 py-1 text-xs rounded-full">ویژه</span>
                                    @endif
                                    @if($article->is_breaking)
                                    <span class="bg-red-100 text-red-800 px-2 py-1 text-xs font-bold rounded-full animate-pulse-red">خبر فوری</span>
                                    @endif
                                </div>
                                <a href="{{ route('articles.show', $article) }}"
                                   class="btn-newspaper px-4 py-2 text-sm rounded-lg">
                                    ادامه مطلب
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($articles->hasPages())
                <div class="mt-12">
                    <div class="flex justify-center">
                        {{ $articles->appends(request()->query())->links() }}
                    </div>
                </div>
                @endif
            @else
                <!-- No Results -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-4">مقاله‌ای یافت نشد</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        متأسفانه هیچ مقاله‌ای با معیارهای جستجوی شما یافت نشد. لطفاً کلمات کلیدی دیگری را امتحان کنید.
                    </p>
                    <a href="{{ route('articles.index') }}"
                       class="btn-newspaper px-8 py-3 rounded-lg">
                        مشاهده همه مقالات
                    </a>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-newspaper-lg p-6 mb-8">
                <h3 class="text-xl font-black text-gray-900 mb-6 border-b-2 border-gray-200 pb-3">دسته‌بندی‌ها</h3>
                <div class="space-y-3">
                    @foreach($categories as $category)
                    <a href="{{ route('articles.index', ['category' => $category->slug]) }}"
                       class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors group {{ request('category') == $category->slug ? 'bg-blue-50 border-r-4 border-blue-600' : '' }}">
                        <div class="flex items-center">
                            @if($category->image)
                            <img src="{{ Storage::url($category->image) }}"
                                 alt="{{ $category->name }}"
                                 class="w-8 h-8 rounded-full object-cover ml-3">
                            @else
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center ml-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            @endif
                            <span class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $category->name }}
                            </span>
                        </div>
                        <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded-full">
                            {{ $category->articles_count }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Popular Tags -->
            <div class="bg-white rounded-lg shadow-newspaper-lg p-6 mb-8">
                <h3 class="text-xl font-black text-gray-900 mb-6 border-b-2 border-gray-200 pb-3">برچسب‌های محبوب</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('articles.index', ['search' => 'دبی']) }}"
                       class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-bold rounded-full hover:bg-blue-200 transition-colors">
                        دبی
                    </a>
                    <a href="{{ route('articles.index', ['search' => 'سفر']) }}"
                       class="px-3 py-1 bg-green-100 text-green-800 text-sm font-bold rounded-full hover:bg-green-200 transition-colors">
                        سفر
                    </a>
                    <a href="{{ route('articles.index', ['search' => 'املاک']) }}"
                       class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-bold rounded-full hover:bg-purple-200 transition-colors">
                        املاک
                    </a>
                    <a href="{{ route('articles.index', ['search' => 'کسب‌وکار']) }}"
                       class="px-3 py-1 bg-red-100 text-red-800 text-sm font-bold rounded-full hover:bg-red-200 transition-colors">
                        کسب‌وکار
                    </a>
                    <a href="{{ route('articles.index', ['search' => 'هتل']) }}"
                       class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-bold rounded-full hover:bg-yellow-200 transition-colors">
                        هتل
                    </a>
                    <a href="{{ route('articles.index', ['search' => 'خرید']) }}"
                       class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm font-bold rounded-full hover:bg-indigo-200 transition-colors">
                        خرید
                    </a>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="bg-gradient-newspaper rounded-lg shadow-newspaper-lg p-6 text-white">
                <h3 class="text-xl font-black mb-4">خبرنامه</h3>
                <p class="text-blue-100 mb-6">برای دریافت آخرین اخبار دبی، ایمیل خود را وارد کنید.</p>
                <form class="space-y-4">
                    <input type="email"
                           placeholder="ایمیل شما"
                           class="w-full px-4 py-3 rounded-lg text-gray-900 focus:ring-2 focus:ring-white focus:outline-none">
                    <button type="submit"
                            class="w-full btn-news px-4 py-3 rounded-lg">
                        عضویت
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
