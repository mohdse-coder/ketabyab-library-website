@extends('layouts.app')

@section('content')
<div class="container">
    <h2>پلن‌های موجود</h2>
    <div style="
    background:#e3f2fd;
    border:1px solid #90caf9;
    padding:15px;
    border-radius:10px;
    margin-bottom:25px;
    color:#0d47a1;
">
    🔔 برای ارتقا پلن، روی دکمه سبز «ارتقا به این پلن» کلیک کنید.
</div>

    <div class="row">
        @php
    $currentPlan = Auth::user()->activePlan();
@endphp

        @foreach($plans as $plan)
    <div class="col-md-4">
        <div class="card mb-3"
             style="
                border-radius:15px;
                {{ $currentPlan && $currentPlan->id == $plan->id ? 'border:2px solid #2e7d32;' : '' }}
             ">
            <div class="card-body text-center">

                <h4 class="card-title">{{ $plan->name }}</h4>

                <p>📚 حداکثر کتابخانه: <b>{{ $plan->max_libraries }}</b></p>
                <p>📖 حداکثر کتاب: <b>{{ $plan->max_books }}</b></p>

                @if($currentPlan && $currentPlan->id == $plan->id)
    <span style="color:green;font-weight:bold;">
        ✔ پلن فعلی شما
    </span>
@else
    <form action="{{ route('plans.upgrade', $plan->id) }}" method="POST">
        @csrf
        <button type="submit"
            style="
                background:#4caf50;
                color:white;
                padding:10px 20px;
                border:none;
                border-radius:8px;
                cursor:pointer;
                font-size:16px;
            ">
            🚀 ارتقا به این پلن
        </button>
    </form>
@endif


            </div>
        </div>
    </div>
@endforeach

    </div>
</div>
@endsection
