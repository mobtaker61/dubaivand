@extends('layouts.app')

@section('title', 'درباره ما')
@section('description', 'درباره DubaiVand - مرجع کامل اطلاعات زندگی، سفر و کسب‌وکار در دبی')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-900 to-indigo-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-black mb-6 text-shadow-newspaper-lg">
                درباره DubaiVand
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                مرجع کامل و معتبر اطلاعات زندگی، سفر و کسب‌وکار در دبی
            </p>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-newspaper-lg p-8">
        <div class="prose prose-lg max-w-none">
            <h2 class="text-3xl font-black text-gray-900 mb-6">درباره ما</h2>

            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                <strong>DubaiVand</strong> مرجع کامل و معتبر اطلاعات زندگی، سفر و کسب‌وکار در دبی است. ما با هدف ارائه اطلاعات دقیق، به‌روز و کاربردی برای فارسی‌زبانان علاقه‌مند به دبی تأسیس شده‌ایم.
            </p>

            <h3 class="text-2xl font-bold text-gray-900 mb-4">ماموریت ما</h3>
            <p class="text-gray-600 mb-6 leading-relaxed">
                ارائه اطلاعات جامع و معتبر درباره تمام جنبه‌های زندگی در دبی، از جمله سفر، اقامت، کسب‌وکار، املاک، تفریحات و فرهنگ این شهر شگفت‌انگیز.
            </p>

            <h3 class="text-2xl font-bold text-gray-900 mb-4">خدمات ما</h3>
            <ul class="list-disc list-inside text-gray-600 mb-6 space-y-2">
                <li>اخبار و اطلاعات به‌روز دبی</li>
                <li>راهنمای سفر و اقامت</li>
                <li>اطلاعات کسب‌وکار و سرمایه‌گذاری</li>
                <li>راهنمای املاک و مستغلات</li>
                <li>اطلاعات تفریحات و جاذبه‌ها</li>
                <li>راهنمای فرهنگ و آداب و رسوم</li>
            </ul>

            <h3 class="text-2xl font-bold text-gray-900 mb-4">تیم ما</h3>
            <p class="text-gray-600 mb-6 leading-relaxed">
                تیم تحریریه DubaiVand متشکل از کارشناسان مجرب در زمینه‌های مختلف است که با تجربه‌های عمیق در حوزه دبی و امارات متحده عربی، اطلاعات دقیق و کاربردی را در اختیار شما قرار می‌دهند.
            </p>

            <h3 class="text-2xl font-bold text-gray-900 mb-4">ارزش‌های ما</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h4 class="text-lg font-bold text-blue-900 mb-2">دقت و اعتبار</h4>
                    <p class="text-blue-700">اطلاعات ارائه شده همیشه دقیق، به‌روز و قابل اعتماد است.</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg">
                    <h4 class="text-lg font-bold text-green-900 mb-2">جامعیت</h4>
                    <p class="text-green-700">پوشش کامل تمام جنبه‌های مورد نیاز برای زندگی در دبی.</p>
                </div>
                <div class="bg-purple-50 p-6 rounded-lg">
                    <h4 class="text-lg font-bold text-purple-900 mb-2">کاربردی بودن</h4>
                    <p class="text-purple-700">اطلاعات ارائه شده عملی و قابل استفاده در زندگی واقعی.</p>
                </div>
                <div class="bg-red-50 p-6 rounded-lg">
                    <h4 class="text-lg font-bold text-red-900 mb-2">شفافیت</h4>
                    <p class="text-red-700">شفافیت کامل در ارائه اطلاعات و منابع.</p>
                </div>
            </div>

            <h3 class="text-2xl font-bold text-gray-900 mb-4">تماس با ما</h3>
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">اطلاعات تماس</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                info@dubaivand.com
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                </svg>
                                dubaivand.com
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">ساعات کاری</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li>شنبه تا چهارشنبه: 9 صبح تا 6 عصر</li>
                            <li>پنجشنبه: 9 صبح تا 2 عصر</li>
                            <li>جمعه: تعطیل</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
