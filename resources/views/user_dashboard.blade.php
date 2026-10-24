<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>داشبورد کاربر</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<header>
    <img src="https://img.icons8.com/?size=100&id=jw2ihM2uHfwE&format=png&color=000000" alt="library" width="60" height="60">
    <h1 class="h1-class"><b>داشبورد کاربری</b></h1>
    <form method="GET" action="{{ route('search') }}">
    <input type="text" name="search" placeholder="نام کتاب را وارد کنید..."
           class="search">
    <button type="submit"
            class="search">
         جستجو
    </button>
</form>

    <div class="header-right">
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer;color:#ffff;font-size:16px;">
                خروج
            </button>

        </form>
    </div>

</header>

<section class="search-section" style="margin-top:40px;">
    <h2 style="color:#2e7d32;">👋 سلام {{ Auth::user()->name }}</h2>
    <p style="color:#444; margin-bottom:20px;">
        خوش آمدید! از این بخش می‌توانید کتابخانه‌های خود را مدیریت کنید و اطلاعات حساب خود را مشاهده نمایید.
    </p>

    <!-- 🔹 نمایش پلن فعلی و محدودیت‌ها -->
    @php
    $user = Auth::user();
    $plan = $user->activePlan();

    // تعداد کتابخانه‌ها
    $libraryCount = $user->libraries()->count();

    // تعداد کل کتاب‌ها در همه کتابخانه‌های کاربر
    $bookCount = $user->libraries()->withCount('books')->get()->sum('books_count');
@endphp

<div style="background:#e8f5e9;padding:15px;border-radius:10px;margin-bottom:20px;color:#2e7d32;">
    @if(session('success'))
    <div style="background:#e3fcef;color:#2e7d32;padding:12px;border-radius:10px;margin-bottom:15px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#ffebee;color:#c62828;padding:12px;border-radius:10px;margin-bottom:15px;">
        {{ session('error') }}
    </div>
@endif

    پلن شما: <b>{{ $plan ? $plan->name : 'پلن نامشخص' }}</b><br>
    کتابخانه‌های ثبت‌شده: <b>{{ $libraryCount }}/{{ $plan ? $plan->max_libraries : '-' }}</b><br>
    تعداد کتاب‌ها: <b>{{ $bookCount }}/{{ $plan ? $plan->max_books : '-' }}</b>
</div>

@if(session('error'))
    <div style="background:#ffebee;color:#c62828;padding:10px;border-radius:8px;margin-bottom:20px;">
        {{ session('error') }}
    </div>
@endif

@if($libraryCount >= $plan->max_libraries)
    <div style="
        background:#fff3e0;
        border:1px solid #ffcc80;
        padding:20px;
        border-radius:12px;
        margin-bottom:30px;
        text-align:center;
    ">
        <h3 style="color:#ef6c00;">🚀 ارتقا پلن</h3>
        <p style="color:#555;">
            شما به سقف تعداد کتابخانه‌های پلن فعلی رسیده‌اید.
        </p>

        <a href="{{ route('plans.index') }}"
           style="
               display:inline-block;
               margin-top:10px;
               padding:10px 25px;
               background:#2e7d32;
               color:white;
               border-radius:8px;
               text-decoration:none;
           ">
            مشاهده و ارتقا پلن
        </a>
    </div>
@endif

    <!-- 🔹 کارت‌های اکشن -->
    <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:20px; margin-top:30px;">

        <!-- کارت ۱: ایجاد کتابخانه -->
<a href="{{ $libraryCount >= $plan->max_libraries ? '#' : route('libraries.create') }}"
   style="
       width:260px;
       background:white;
       border-radius:12px;
       padding:20px;
       box-shadow:0 4px 10px rgba(0,0,0,0.1);
       text-decoration:none;
       color:#2e7d32;
       text-align:center;
       transition:0.3s;
       {{ $libraryCount >= $plan->max_libraries ? 'opacity:0.5;pointer-events:none;' : '' }}
   ">
    <img src="https://img.icons8.com/?size=100&id=61088&format=png&color=2e7d32" width="60">
    <h3>ایجاد کتابخانه جدید</h3>
    <p style="color:#666;">
        {{ $libraryCount >= $plan->max_libraries ? 'سقف کتابخانه‌هایتان پر شده است.' : 'افزودن کتابخانه جدید به سامانه' }}
    </p>
</a>



        <!-- کارت ۲: کتابخانه‌های من -->
        <a href="{{ route('libraries.index') }}" style="width:260px;background:white;border-radius:12px;padding:20px;
                box-shadow:0 4px 10px rgba(0,0,0,0.1);text-decoration:none;color:#388e3c;text-align:center;transition:0.3s;">
            <img src="https://img.icons8.com/?size=100&id=114441&format=png&color=388e3c" width="60">
            <h3>کتابخانه‌های من</h3>
            <p style="color:#666;">مشاهده و مدیریت کتابخانه‌ها</p>
        </a>

        <!-- کارت ۳: تاریخچه -->
        <a href="/user/orders" style="width:260px;background:white;border-radius:12px;padding:20px;
                box-shadow:0 4px 10px rgba(0,0,0,0.1);text-decoration:none;color:#4caf50;text-align:center;transition:0.3s;">
            <img src="https://img.icons8.com/?size=100&id=59903&format=png&color=4caf50" width="60">
            <h3>تاریخچه من</h3>
            <p style="color:#666;">مشاهده سفارش‌ها و وضعیت‌ها</p>
        </a>

    </div>
</section>



</body>
</html>
