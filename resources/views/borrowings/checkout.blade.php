@extends('layouts.app')

@section('content')
<div class="container" style="max-width:600px;">
    <h2>اطلاعات ارسال و پرداخت کتاب: {{ $borrowing->book->title }}</h2>

    <form method="POST" action="{{ route('borrowings.checkout.process', $borrowing->id) }}">
        @csrf
        <div class="mb-3">
            <label>آدرس:</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>شماره تماس:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>روش پرداخت:</label>
            <select name="payment_method" class="form-control" required>
                <option value="online">پرداخت آنلاین</option>
                <option value="cash">پرداخت نقدی در هنگام تحویل</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">ثبت اطلاعات و پرداخت</button>
    </form>
</div>
@endsection
