@extends('layouts.app')

@section('content')
<div class="libraries-container">
    <h2>تاریخچه امانت‌ها</h2>

    @if($orders->isEmpty())
        <p>هیچ سفارشی ندارید.</p>
    @else
        <table class="users-table">
            <thead>
                <tr>
                    <th>نام کتاب</th>
                    <th>تاریخ امانت</th>
                    <th>تاریخ بازگشت</th>
                    <th>وضعیت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->book->name }}</td>
                    <td>{{ $order->borrowed_at->format('Y-m-d') }}</td>
                    <td>{{ $order->returned_at ? $order->returned_at->format('Y-m-d') : '–' }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
