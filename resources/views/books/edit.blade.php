<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ویرایش کتاب</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f0f8f0;">

<section style="width: 500px; padding: 30px; background-color: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    <h2 style="text-align:center; margin-bottom:20px;">ویرایش کتاب</h2>

    <form method="POST" action="{{ route('books.update', ['library' => $library->id, 'book' => $book->id]) }}"
 enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px; text-align:right;">
            <label for="title">نام کتاب *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom:15px; text-align:right;">
            <label for="author">نویسنده</label>
            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" style="width:100%; padding:10px;">
        </div>

        

        <div style="margin-bottom:15px; text-align:right;">
            <label for="cover">تصویر کتاب</label>
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" style="width:150px; display:block; margin-bottom:10px; border-radius:6px;">
            @endif
            <input type="file" name="cover" id="cover" accept="image/*" style="display:block; margin-top:10px;">
        </div>

        <div style="display:flex; justify-content:center; gap:20px;">
            <button type="submit" style="padding:12px 30px; background-color:#2e7d32; color:white;">ذخیره تغییرات</button>
            <a href="{{ route('libraries.show', $library->id) }}" style="padding:12px 30px; background-color:#e53935; color:white;">لغو و بازگشت</a>
        </div>
    </form>
</section>

</body>
</html>
