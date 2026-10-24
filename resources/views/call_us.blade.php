<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تماس با ما</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header>
    <h1 class="h1-class">تماس با ما</h1>
    <a href="{{ route('home') }}" style="color:white; text-decoration:none;">
            بازگشت
        </a>
</header>

<div class="search-section" style="line-height:2; text-align:right; max-width:700px; margin:auto;">

    <h2>📞 ارتباط با ما</h2>
    <p>
        اگر سوال، پیشنهاد یا مشکلی دارید، از طریق اطلاعات زیر یا فرم تماس با ما در ارتباط باشید.
    </p>

    <h3>📍 اطلاعات تماس</h3>
    <ul>
        <li>📧 ایمیل: support@yourlibrary.ir</li>
        <li>☎️ تلفن: 09XXXXXXXXX</li>
        <li>🕒 ساعات پاسخ‌گویی: ۹ الی ۱۸</li>
    </ul>

    <hr>

    <h3>📝 ارسال پیام</h3>

    <form method="POST" action="#">
        @csrf

        <label>نام:</label><br>
        <input type="text" name="name" required><br><br>

        <label>ایمیل:</label><br>
        <input type="email" name="email" required><br><br>

        <label>پیام:</label><br>
        <textarea name="message" rows="5" required></textarea><br><br>

        <button type="submit">ارسال پیام</button>
    </form>

</div>

<footer style="margin-top:40px;">
    <a id="foteer" href="/">صفحه اصلی</a>
</footer>

</body>
</html>
