@extends('layouts.app')

@section('content')
<div class="libraries-container" style="max-width:600px; margin:auto; padding:20px; background:#fff; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
    <h2>ویرایش کتابخانه</h2>

    <form action="{{ route('libraries.update', $library->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3" style="text-align:right;">
            <label>نام کتابخانه</label>
            <input type="text" name="name" value="{{ old('name', $library->name) }}" class="form-control">
        </div>

        <div class="mb-3" style="text-align:right;">
            <label>توضیحات</label>
            <textarea name="description" class="form-control">{{ old('description', $library->description) }}</textarea>
        </div>

        <div class="mb-3" style="text-align:right;">
            <label>کاور</label>
            <input type="file" name="cover" class="form-control">
            @if($library->cover)
                <img src="{{ asset('storage/' . $library->cover) }}" width="150" style="margin-top:10px; border-radius:8px;">
            @endif
        </div>

        <div class="mb-3" style="text-align:right;">
            <label>حریم خصوصی</label>
            <select name="privacy" class="form-control">
                <option value="public" {{ $library->privacy == 'public' ? 'selected' : '' }}>عمومی</option>
                <option value="private" {{ $library->privacy == 'private' ? 'selected' : '' }}>خصوصی</option>
            </select>
        </div>

        <button type="submit" class="btn-edit">ذخیره تغییرات</button>
    </form>
</div>
@endsection
