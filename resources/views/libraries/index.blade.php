@extends('layouts.app')

@section('content')

<header >
        <h2>کتابخانه‌های من</h2>
        <div style="display:flex; gap:6px; margin-right:auto;">
        <a href="{{ route('libraries.create') }}" class="btn-add">+ ایجاد کتابخانه جدید</a>
        <a class="btn-add"href="/user_dashboard">بازگشت به داشبورد</a>
        </div>
    </header>

<div class="libraries-container">


    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="libraries-grid">
        @forelse($libraries as $library)
            <div class="library-card">

                <div class="library-cover">
                    @if($library->cover)
                        <img src="{{ asset('storage/' . $library->cover) }}" alt="">
                    @else
                        <img src="https://img.icons8.com/ios-filled/200/2e7d32/books.png" alt="">
                    @endif
                </div>

                <h3>{{ $library->name }}</h3>

                <p class="library-desc">
                    {{ $library->description ? $library->description : 'بدون توضیحات' }}
                </p>

                <span class="privacy-tag {{ $library->privacy }}">
                    {{ $library->privacy == 'public' ? 'عمومی' : 'خصوصی' }}
                </span>

                <div class="card-buttons">

    <a href="{{ route('libraries.show', $library->id) }}"
       class="btn-add">
        مشاهده
    </a>

    <a href="{{ route('libraries.edit', $library->id) }}"
       class="btn-edit">
        ویرایش
    </a>

    <form action="{{ route('libraries.destroy', $library->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn-delete"
                onclick="return confirm('حذف شود؟')">
             حذف
        </button>
    </form>

</div>

            </div>
        @empty
            <p>هیچ کتابخانه‌ای ایجاد نکرده‌اید.</p>
        @endforelse
    </div>
</div>
@endsection
