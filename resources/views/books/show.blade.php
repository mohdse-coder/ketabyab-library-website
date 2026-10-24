@extends('layouts.app')

@section('content')
<div class="container" style="max-width:800px; text-align:right;">

    {{-- نمایش پیام‌ها --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- عنوان کتاب --}}
    <h2 style="color:#2e7d32;">{{ $book->title }}</h2>

    {{-- اطلاعات کتاب --}}
    <div style="margin-top:20px;">
        <p><b>نویسنده:</b> {{ $book->author ?? 'نامشخص' }}</p>
        <p><b>توضیحات کتاب:</b></p>
        <p>{{ $book->description ?? 'توضیحی ثبت نشده است.' }}</p>
        <p>
            <b>وضعیت کتاب:</b>
            @if($book->quantity > 0)
                <span style="color:green;">موجود</span>
            @else
                <span style="color:red;">ناموجود</span>
            @endif
        </p>
    </div>

    <hr>

    {{-- اطلاعات کتابخانه --}}
    <h3 style="margin-top:20px;">📚 اطلاعات کتابخانه</h3>
    <p><b>نام کتابخانه:</b> {{ $book->library->name }}</p>
    <p>
        <b>وضعیت کتابخانه:</b>
        {{ $book->library->privacy == 'public' ? 'عمومی' : 'خصوصی' }}
    </p>
    @if($book->library->cover)
        <img src="{{ asset('storage/' . $book->library->cover) }}"
             style="width:250px; border-radius:12px; margin-top:10px;">
    @endif

    <hr>

    {{-- دکمه امانت گرفتن --}}
    <div style="margin-top:20px;">
        @if($book->quantity < 1)
            <button class="btn btn-secondary" disabled>
                📕 در حال حاضر موجود نیست
            </button>

        @elseif(auth()->guest())
            <a href="{{ route('login') }}" class="btn btn-warning">
                🔐 برای امانت وارد شوید
            </a>

        @elseif(auth()->id() == $book->library->user_id)
            <p>شما مالک این کتابخانه هستید و نمی‌توانید کتاب خود را امانت بگیرید.</p>

        @else
            {{-- فرم امانت گرفتن کتاب --}}
            <form method="POST" action="{{ route('books.borrow', $book->id) }}">
                @csrf
                <button type="submit" class="btn btn-success">
                    📗 امانت گرفتن کتاب
                </button>
            </form>
        @endif
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }} - لطفا کتاب را تا {{ now()->addDays(14)->format('Y-m-d') }} بازگردانید.
    </div>
@endif

    </div>

</div>
@endsection
