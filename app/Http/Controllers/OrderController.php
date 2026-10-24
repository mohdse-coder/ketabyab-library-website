<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function history()
    {
        $user = Auth::user();

        // گرفتن تمام امانت‌های کاربر همراه با اطلاعات کتاب و کتابخانه
        $borrowings = $user->borrowings()->with('book.library')->orderBy('borrowed_at','desc')->get();
        return view('user.history', compact('borrowings'));

    }
}
