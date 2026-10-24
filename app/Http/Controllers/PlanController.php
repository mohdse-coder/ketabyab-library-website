<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // نمایش همه پلن‌ها
    public function index()
    {
        $plans = Plan::all(); // همه پلن‌ها
        return view('plans.index', compact('plans'));
    }

    // ارتقا پلن کاربر
    public function upgrade(Plan $plan)
{
    $user = Auth::user();

    // پلن فعال فعلی کاربر
    $currentSubscription = $user->subscriptions()
        ->where('status', 'active')
        ->latest()
        ->first();

    // اگر همین پلن فعلیه
    if ($currentSubscription && $currentSubscription->plan_id == $plan->id) {
        return back()->with('error', 'این پلن در حال حاضر برای شما فعال است.');
    }

    // غیرفعال کردن همه اشتراک‌های قبلی
    $user->subscriptions()->update(['status' => 'inactive']);

    // ساخت اشتراک جدید
    $user->subscriptions()->create([
        'plan_id' => $plan->id,
        'status'  => 'active',
    ]);

    return redirect()
        ->route('user_dashboard')
        ->with('success', '🎉 پلن شما با موفقیت ارتقا یافت');
}

}
