@extends('layouts.app')

@section('content')
<div class="libraries-container">

    <h2 style="margin-bottom:20px;">
        نتایج جستجو برای "{{ $query }}"
    </h2>

    @if($books->isEmpty())
        <p>هیچ کتابی با این نام پیدا نشد.</p>
    @else
        <div class="libraries-grid">
            @foreach($books as $book)
                <div class="library-card">

                    {{-- اسم کتابخانه --}}
                    <h4 style="color:#2e7d32; margin-bottom:8px;">
                        {{ $book->library->name }}
                    </h4>

                    {{-- عکس کتابخانه --}}
                    <div class="library-cover">
                        @if($book->library->cover)
                            <img src="{{ asset('storage/' . $book->library->cover) }}">
                        @else
                            <img src="https://img.icons8.com/ios-filled/200/2e7d32/library.png">
                        @endif
                    </div>

                    {{-- اسم کتاب --}}
                    <h3 style="margin-top:10px;">
                        {{ $book->title }}
                    </h3>

                    {{-- دکمه جزئیات --}}
                    <a href="{{ route('books.show', $book->id) }}"
                       class="btn-add"
                       style="display:inline-block; margin-top:10px;">
                        مشاهده جزئیات
                    </a>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
