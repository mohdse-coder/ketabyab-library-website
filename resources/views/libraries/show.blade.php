<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $library->name }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color:#f0f8f0; font-family:sans-serif;">

<section style="max-width:800px; margin:30px auto; padding:20px; background:#fff; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">

    <h2>{{ $library->name }}</h2>
    <p>{{ $library->description }}</p>

    @if($library->cover)
        <img src="{{ asset('storage/' . $library->cover) }}" alt="کاور کتابخانه" style="width:100%; border-radius:8px; margin-bottom:15px;">
    @endif

    <a href="{{ route('books.create', $library->id) }}"
       style="display:inline-block; margin-bottom:20px; padding:10px 20px; background:#2e7d32; color:white; border-radius:6px; text-decoration:none;">
       ➕ افزودن کتاب
    </a>

    <hr>

    <h3>کتاب‌های این کتابخانه</h3>
    @if($books && $books->count())
        <div style="display:flex; flex-wrap:wrap; gap:20px;">
            @foreach($books as $book)
                <div style="border:1px solid #ccc; padding:15px; border-radius:8px; width:200px; text-align:center;">
                    <h4>{{ $book->title }}</h4>
                    @if($book->author)
                        <p>نویسنده: {{ $book->author }}</p>
                    @endif
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" style="width:150px; margin-top:10px; border-radius:6px;">
                    @endif
                    <div style="margin-top:10px; display:flex; justify-content:center; gap:10px;">
                        <a href="{{ route('books.edit', ['library' => $library->id, 'book' => $book->id]) }}"
   style="padding:5px 10px; background:#1976d2; color:white; border-radius:4px; text-decoration:none;">
   ✏️ ویرایش
</a>

<form action="{{ route('books.destroy', ['library' => $library->id, 'book' => $book->id]) }}"
      method="POST"
      style="display:inline;"
      onsubmit="return confirm('آیا مطمئن هستید؟')">
    @csrf
    @method('DELETE')
    <button type="submit"
            style="padding:5px 10px; background:#e53935; color:white; border:none; border-radius:4px; cursor:pointer;">
        🗑️ حذف
    </button>
</form>


                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>هنوز کتابی ثبت نشده است</p>
    @endif

</section>

</body>
</html>
