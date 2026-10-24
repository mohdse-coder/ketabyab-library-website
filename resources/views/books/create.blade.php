<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن کتاب جدید</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f0f8f0;">

<section style="width: 500px; padding: 30px; background-color: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    <h2 style="text-align:center; margin-bottom:20px;">افزودن کتاب جدید</h2>

    <form method="POST" action="{{ route('books.store', $library->id) }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom:15px; text-align:right;">
            <label for="title">نام کتاب *</label>
            <input type="text" name="title" id="title" required style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom:15px; text-align:right;">
            <label for="author">نویسنده</label>
            <input type="text" name="author" id="author" style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom:15px; text-align:right;">
            <label for="cover">تصویر کتاب</label>
            <input type="file" name="cover" id="cover" accept="image/*" style="display:block; margin-top:10px;">
        </div>

        <div style="display:flex; justify-content:center; gap:20px;">
            <button type="submit" style="padding:12px 30px; background-color:#2e7d32; color:white;">ذخیره کتاب</button>
            <a href="{{ route('libraries.show', $library->id) }}" style="padding:12px 30px; background-color:#e53935; color:white;">لغو و بازگشت</a>
        </div>
    </form>
</section>

</body>
</html>
