@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->excerpt ?? Str::limit(strip_tags($article->content), 160))
@section('keywords', $article->category->name ?? 'دبی, اخبار, مقالات')

@section('content')
<!-- Article Header -->
<div class="article-header bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-20">
    <!-- Featured Image Background -->
    @if($article->featured_image)
    <div class="article-header-bg">
        <img src="{{ Storage::url($article->featured_image) }}"
             alt="{{ $article->title }}">
        <div class="article-header-overlay"></div>
    </div>
    @endif

    <!-- Background Pattern -->
    <div class="article-header-pattern">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="article-header-content max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Breadcrumb -->
        <nav class="flex justify-center mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 space-x-reverse">
                <li>
                    <a href="{{ route('home') }}" class="text-blue-300 hover:text-white transition-colors duration-300">
                        🏠 صفحه اصلی
                    </a>
                </li>
                <li class="text-gray-400">/</li>
                <li>
                    <a href="{{ route('articles.index') }}" class="text-blue-300 hover:text-white transition-colors duration-300">
                        📰 اخبار
                    </a>
                </li>
                <li class="text-gray-400">/</li>
                <li>
                    <a href="{{ route('categories.show', $article->category) }}" class="text-blue-300 hover:text-white transition-colors duration-300">
                        {{ $article->category->name }}
                    </a>
                </li>
            </ol>
        </nav>

        <!-- Category Badge -->
        <div class="mb-6">
            <span class="badge-category px-6 py-3 text-lg rounded-full shadow-lg">
                {{ $article->category->name ?? 'عمومی' }}
            </span>
            @if($article->is_breaking)
            <span class="bg-red-600 text-white px-6 py-3 text-lg font-black rounded-full shadow-lg animate-pulse mr-4">
                🔥 خبر فوری
            </span>
            @endif
            @if($article->is_featured)
            <span class="bg-yellow-500 text-white px-6 py-3 text-lg font-black rounded-full shadow-lg mr-4">
                ⭐ ویژه
            </span>
            @endif
        </div>

        <!-- Article Title -->
        <h1 class="text-4xl md:text-6xl font-black mb-8 leading-tight drop-shadow-lg">
            {{ $article->title }}
        </h1>

        <!-- Article Meta -->
        <div class="flex flex-wrap items-center justify-center gap-6 text-lg">
            <div class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                <svg class="w-5 h-5 ml-2 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $article->published_at ? $article->published_at->format('Y/m/d') : 'بدون تاریخ' }}
            </div>
            <div class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                <svg class="w-5 h-5 ml-2 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                {{ $article->view_count ?? 0 }} بازدید
            </div>
            @if($article->source_name)
            <div class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                <svg class="w-5 h-5 ml-2 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
                {{ $article->source_name }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        <!-- Article Content -->
        <div class="lg:col-span-3">
            <!-- Article Excerpt -->
            @if($article->excerpt)
            <div class="mb-12">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8 rounded-3xl border-r-4 border-blue-500">
                    <p class="text-lg text-gray-700 leading-relaxed">{{ $article->excerpt }}</p>
                </div>
            </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none">
                <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                    {!! $article->content !!}
                </div>
            </div>

            <!-- Article Footer -->
            <div class="mt-12 bg-gray-50 p-8 rounded-3xl">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600">این مطلب را به اشتراک بگذارید:</span>
                        <div class="flex gap-3">
                            <a href="#" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="bg-green-600 text-white p-3 rounded-full hover:bg-green-700 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="bg-blue-800 text-white p-3 rounded-full hover:bg-blue-900 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @if($article->source_url)
                    <a href="{{ $article->source_url }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center bg-gray-800 text-white px-6 py-3 rounded-2xl hover:bg-gray-900 transition-colors duration-300">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        مشاهده منبع اصلی
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Author Info -->
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-8 border-t-4 border-blue-500">
                <h3 class="text-2xl font-black text-gray-900 mb-6 border-b-2 border-gray-200 pb-4">✍️ نویسنده</h3>
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-black text-gray-900 mb-2">تیم تحریریه</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        تیم متخصص ما در حوزه اخبار و اطلاعات دبی، همواره در تلاش است تا به‌روزترین و معتبرترین اطلاعات را در اختیار شما قرار دهد.
                    </p>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles && $relatedArticles->count() > 0)
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-8 border-t-4 border-green-500">
                <h3 class="text-2xl font-black text-gray-900 mb-6 border-b-2 border-gray-200 pb-4">📚 مقالات مرتبط</h3>
                <div class="space-y-4">
                    @foreach($relatedArticles->take(3) as $relatedArticle)
                    <article class="group">
                        <a href="{{ route('articles.show', $relatedArticle) }}" class="block">
                            @if($relatedArticle->featured_image)
                            <div class="relative overflow-hidden rounded-2xl mb-3">
                                <img src="{{ Storage::url($relatedArticle->featured_image) }}"
                                     alt="{{ $relatedArticle->title }}"
                                     class="w-full h-32 object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            @endif
                            <h4 class="text-sm font-black text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
                                {{ Str::limit($relatedArticle->title, 60) }}
                            </h4>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                    {{ $relatedArticle->category->name ?? 'عمومی' }}
                                </span>
                                <span>{{ $relatedArticle->published_at ? $relatedArticle->published_at->format('Y/m/d') : 'بدون تاریخ' }}</span>
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Category Info -->
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-8 border-t-4 border-purple-500">
                <h3 class="text-2xl font-black text-gray-900 mb-6 border-b-2 border-gray-200 pb-4">📂 دسته‌بندی</h3>
                <div class="text-center">
                    @if($article->category->image)
                    <img src="{{ Storage::url($article->category->image) }}"
                         alt="{{ $article->category->name }}"
                         class="w-20 h-20 rounded-full object-cover mx-auto mb-4">
                    @else
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    @endif
                    <h4 class="text-lg font-black text-gray-900 mb-2">{{ $article->category->name }}</h4>
                    @if($article->category->description)
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        {{ $article->category->description }}
                    </p>
                    @endif
                    <a href="{{ route('categories.show', $article->category) }}"
                       class="inline-block bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-3 rounded-2xl font-black hover:from-purple-700 hover:to-purple-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        مشاهده همه مقالات
                    </a>
                </div>
            </div>

            <!-- Tags -->
            @if($article->meta_data && isset($article->meta_data['tags']))
            <div class="bg-white rounded-3xl shadow-xl p-8 border-t-4 border-yellow-500">
                <h3 class="text-2xl font-black text-gray-900 mb-6 border-b-2 border-gray-200 pb-4">🏷️ برچسب‌ها</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($article->meta_data['tags'] as $tag)
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-2 rounded-full text-sm font-medium hover:bg-yellow-200 transition-colors duration-300 cursor-pointer">
                        #{{ $tag }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Related Articles Section -->
@if($relatedArticles && $relatedArticles->count() > 3)
<div class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-black text-gray-900 mb-4">📚 مقالات بیشتر در این دسته</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-green-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedArticles->skip(3)->take(6) as $relatedArticle)
            <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                @if($relatedArticle->featured_image)
                <div class="relative overflow-hidden">
                    <img src="{{ Storage::url($relatedArticle->featured_image) }}"
                         alt="{{ $relatedArticle->title }}"
                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full">
                            {{ $relatedArticle->category->name ?? 'عمومی' }}
                        </span>
                        @if($relatedArticle->is_breaking)
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full animate-pulse">
                            🔥 فوری
                        </span>
                        @endif
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-3 leading-tight group-hover:text-blue-600 transition-colors duration-300">
                        <a href="{{ route('articles.show', $relatedArticle) }}">
                            {{ Str::limit($relatedArticle->title, 80) }}
                        </a>
                    </h3>
                    @if($relatedArticle->excerpt)
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ Str::limit($relatedArticle->excerpt, 100) }}</p>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 text-xs">
                            {{ $relatedArticle->published_at ? $relatedArticle->published_at->format('Y/m/d') : 'بدون تاریخ' }}
                        </span>
                        <a href="{{ route('articles.show', $relatedArticle) }}"
                           class="text-blue-600 hover:text-blue-700 text-sm font-bold group-hover:scale-110 transition-all duration-300">
                            ادامه مطلب →
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('categories.show', $article->category) }}"
               class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-2xl font-black hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                📂 مشاهده همه مقالات {{ $article->category->name }}
            </a>
        </div>
    </div>
</div>
@endif
@endsection
