<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد کتابخانه جدید</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- هدر -->
    <header style="display:flex; gap:6px;">
        <img src="https://img.icons8.com/?size=100&id=jw2ihM2uHfwE&format=png&color=000000" alt="library" width="60" height="60">
        <h1 class="h1-class"><b>ایجاد کتابخانه جدید</b></h1>
        <div class="header-right">
            <a class="nav-link" href="/user_dashboard">بازگشت به داشبورد</a>
        </div>
    </header>

    <!-- فرم ایجاد کتابخانه -->
    <section class="add-library" style="margin-top:40px;">
            <form method="POST" action="{{ route('libraries.store') }}" enctype="multipart/form-data">

            @csrf
            <!-- نام کتابخانه (Required) -->
            <div style="margin-bottom:20px; text-align:right;">
                <label for="name" style="font-weight:bold;">نام کتابخانه <span style="color:red;">*</span></label>
                <input type="text" name="name" id="name" placeholder="مثال: کتابخانه شخصی من" required
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
            </div>

            <!-- توضیح کوتاه (Optional) -->
            <div style="margin-bottom:20px; text-align:right;">
                <label for="description" style="font-weight:bold;">توضیح کوتاه</label>
                <textarea name="description" id="description" rows="4" placeholder="مثال: در این کتابخانه، کتاب‌های علمی و داستانی خودم را نگهداری می‌کنم"
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></textarea>
            </div>

            <!-- تصویر کاور (Optional) -->
            <div style="margin-bottom:20px; text-align:right;">
                <label for="cover" style="font-weight:bold;">تصویر کاور کتابخانه</label>
                <input type="file" name="cover" id="cover" accept="image/*"
                    style="display:block; margin-top:10px;">
                <small>پیشنهاد: سایز تصویر 600×200 px</small>
            </div>

            <!-- دسته‌بندی‌ها (Optional / Dynamic) -->
            <div style="margin-bottom:20px; text-align:right;">
                <label for="categories" style="font-weight:bold;">دسته‌بندی‌ها</label>
                <input type="text" name="categories[]" placeholder="مثال: علمی, داستانی, تاریخی"
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
                <small>می‌توانید چند دسته‌بندی با کاما جدا کنید. بعداً امکان اضافه/حذف دسته‌ها وجود دارد.</small>
            </div>

            <br>

            <div style="margin-bottom:20px; text-align:right;">
    <label style="font-weight:bold;">حریم کتابخانه</label>
    <select name="privacy"
            required
            style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
        <option value="public">عمومی</option>
        <option value="private">خصوصی</option>
    </select>
</div>

            <!-- دکمه‌ها -->
            <div style="display:flex; justify-content:center; gap:20px;">
                <button type="submit"
                    style="padding:12px 30px; background-color:#2e7d32; color:white; border:none; border-radius:8px; cursor:pointer;">
                    ذخیره کتابخانه
                </button>
                <a href="/user_dashboard"
                    style="padding:12px 30px; background-color:#e53935; color:white; border-radius:8px; text-decoration:none;">
                    لغو و بازگشت
                </a>
            </div>

        </form>
    </section>

</body>د
</html>
