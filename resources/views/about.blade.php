<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>درباره ما</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header>
    <h1 class="h1-class">درباره ما</h1>
    <a href="{{ route('home') }}" style="color:white; text-decoration:none;">
            بازگشت
        </a>
</header>

<div class="search-section" style="line-height:2; text-align:right;">

    <h2>📘 کتابخانه آنلاین کاربرمحور</h2>

    <p>
        سامانه کتابخانه آنلاین کاربرمحور با هدف ایجاد بستری ساده و قابل‌اعتماد برای اشتراک‌گذاری کتاب‌ها ایجاد شده است.
    </p>

    <h3>❓ مسئله</h3>
    <p>
        بسیاری از کتاب‌ها بدون استفاده باقی می‌مانند در حالی که دیگران به آن‌ها نیاز دارند.
    </p>

    <h3>💡 راه‌حل</h3>
    <p>
        امکان ثبت کتابخانه شخصی و امانت دادن کتاب‌ها بین کاربران در یک بستر امن.
    </p>

    <h3>⭐ مزیت‌ها</h3>
    <ul>
        <li>ثبت کتابخانه شخصی</li>
        <li>امانت کتاب بین کاربران</li>
        <li>قوانین شفاف</li>
        <li>سطح‌بندی کتابخانه‌ها</li>
    </ul>

    <h3>🚀 چشم‌انداز</h3>
    <p>
        ایجاد بزرگ‌ترین شبکه اشتراک کتاب در ایران.
    </p>

</div>

<footer>
    <a id="foteer" href="/">صفحه اصلی</a>
</footer>

</body>
</html>
