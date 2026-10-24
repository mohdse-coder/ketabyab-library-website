<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    // نمایش فرم اطلاعات ارسال و پرداخت
    public function checkout(Borrowing $borrowing)
    {
        $this->authorize('view', $borrowing); // فقط کاربر خودش میتونه
        return view('borrowings.checkout', compact('borrowing'));
    }

    // پردازش فرم ارسال و پرداخت
    public function processCheckout(Request $request, Borrowing $borrowing)
    {
        $this->authorize('view', $borrowing);

        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string|in:online,cash',
        ]);

        $borrowing->update([
            'delivery_address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'status' => $request->payment_method == 'online' ? 'pending_payment' : 'cash_on_delivery',
        ]);

        return redirect()->route('user.history')
                         ->with('success', 'اطلاعات ارسال ثبت شد. لطفاً پرداخت را انجام دهید.');
    }
}
