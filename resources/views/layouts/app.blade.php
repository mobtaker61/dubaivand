<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DubaiVand') }} - @yield('title', 'اطلاعات دبی')</title>

    <!-- Meta Tags for SEO -->
    <meta name="description" content="@yield('description', 'اطلاعات کامل و به‌روز درباره زندگی، سفر و کسب‌وکار در دبی')">
    <meta name="keywords" content="@yield('keywords', 'دبی, سفر به دبی, زندگی در دبی, کسب‌وکار دبی, امارات')">
    <meta name="author" content="DubaiVand">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'DubaiVand - اطلاعات دبی')">
    <meta property="og:description" content="@yield('og_description', 'اطلاعات کامل و به‌روز درباره زندگی، سفر و کسب‌وکار در دبی')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="DubaiVand">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=vazirmatn:400,500,600,700,800" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Breaking News Bar -->
    <div class="bg-red-600 text-white py-2" x-data="{ open: true }" x-show="open">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 space-x-reverse">
                    <span class="bg-white text-red-600 px-2 py-1 text-xs font-bold rounded">خبر فوری</span>
                    <span class="text-sm font-medium">آخرین اخبار و اطلاعات به‌روز دبی</span>
                </div>
                <button @click="open = false" class="text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-lg border-b-4 border-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Top Header -->
            <div class="py-3 border-b border-gray-200">
                <div class="flex justify-between items-center text-sm text-gray-600">
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <span>{{ now()->format('l j F Y') }}</span>
                        <span>•</span>
                        <span>{{ now()->format('H:i') }}</span>
                    </div>
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <span>دبی، امارات متحده عربی</span>
                        <span>•</span>
                        <span>درجه حرارت: 32°C</span>
                    </div>
                </div>
            </div>

            <!-- Main Header -->
            <div class="flex justify-between items-center py-6">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-4xl font-black text-gray-900 tracking-tight">
                        <span class="text-blue-600">Dubai</span><span class="text-red-600">Vand</span>
                    </a>
                    <div class="mr-4 text-xs text-gray-500 leading-tight">
                        <div>مرجع کامل</div>
                        <div>اطلاعات دبی</div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="hidden lg:block flex-1 max-w-md mx-8">
                    <form action="{{ route('articles.index') }}" method="GET" class="relative">
                        <input type="text"
                               name="search"
                               placeholder="جستجو در اخبار و مقالات..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <button type="submit" class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8 space-x-reverse">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-semibold border-b-2 border-transparent hover:border-blue-600 transition-colors">
                        صفحه اصلی
                    </a>
                    <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-semibold border-b-2 border-transparent hover:border-blue-600 transition-colors">
                        اخبار
                    </a>
                    <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-semibold border-b-2 border-transparent hover:border-blue-600 transition-colors">
                        دسته‌بندی‌ها
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-semibold border-b-2 border-transparent hover:border-blue-600 transition-colors">
                        درباره ما
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-blue-600" x-data @click="$dispatch('toggle-mobile-menu')">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden" x-data="{ open: false }" @toggle-mobile-menu.window="open = !open" x-show="open" x-transition>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-600 px-3 py-2 text-base font-medium">
                    صفحه اصلی
                </a>
                <a href="{{ route('articles.index') }}" class="block text-gray-700 hover:text-blue-600 px-3 py-2 text-base font-medium">
                    اخبار
                </a>
                <a href="{{ route('categories.index') }}" class="block text-gray-700 hover:text-blue-600 px-3 py-2 text-base font-medium">
                    دسته‌بندی‌ها
                </a>
                <a href="{{ route('about') }}" class="block text-gray-700 hover:text-blue-600 px-3 py-2 text-base font-medium">
                    درباره ما
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <span class="text-2xl font-black">
                            <span class="text-blue-400">Dubai</span><span class="text-red-400">Vand</span>
                        </span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed mb-4">
                        مرجع کامل اطلاعات زندگی، سفر و کسب‌وکار در دبی. ما به شما کمک می‌کنیم تا تجربه‌ای بهتر در این شهر شگفت‌انگیز داشته باشید.
                    </p>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-semibold mb-4 text-gray-200">دسترسی سریع</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">صفحه اصلی</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">اخبار</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-white transition-colors">دسته‌بندی‌ها</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">درباره ما</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold mb-4 text-gray-200">تماس با ما</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            info@dubaivand.com
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                            </svg>
                            dubaivand.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} DubaiVand. تمامی حقوق محفوظ است.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
