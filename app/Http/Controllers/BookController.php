<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    // فرم افزودن کتاب
    public function create(Library $library)
    {
        if ($library->user_id !== Auth::id()) abort(403);

        return view('books.create', compact('library'));
    }

    // ذخیره کتاب
    public function store(Request $request, Library $library)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $plan = $user->activePlan();

        // فقط صاحب کتابخانه
        if ($library->user_id !== $user->id) abort(403);

        // محدودیت تعداد کتاب‌ها بر اساس پلن
        if ($library->books()->count() >= $plan->max_books) {
            return back()->withErrors(['plan' => 'سقف مجاز ثبت کتاب پر شده است.']);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'cover' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        $coverPath = $request->hasFile('cover') ? $request->file('cover')->store('books', 'public') : null;

        $library->books()->create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'cover' => $coverPath,
        ]);

        return redirect()->route('libraries.show', $library->id)
                         ->with('success', 'کتاب با موفقیت اضافه شد');
    }

    public function edit(Library $library, Book $book)
    {
        if ($library->user_id !== Auth::id()) abort(403);

        return view('books.edit', compact('library', 'book'));
    }

    public function update(Request $request, Library $library, Book $book)
    {
        if ($library->user_id !== Auth::id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'cover' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover) Storage::disk('public')->delete($book->cover);
            $book->cover = $request->file('cover')->store('books', 'public');
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
        ]);

        return redirect()->route('libraries.show', $library->id)
                         ->with('success', 'کتاب با موفقیت ویرایش شد');
    }

    public function destroy(Library $library, Book $book)
    {
        if ($library->user_id !== Auth::id()) abort(403);

        if ($book->cover) Storage::disk('public')->delete($book->cover);

        $book->delete();

        return redirect()->route('libraries.show', $library->id)
                         ->with('success', 'کتاب با موفقیت حذف شد');
    }

    public function show(Book $book)
    {
        $book->load('library');
        return view('books.show', compact('book'));
    }

    public function borrow(Book $book)
{
    $user = Auth::user();

    // 1️⃣ بررسی موجودی
    if ($book->quantity < 1) {
        return back()->with('error', 'کتاب موجود نیست.');
    }

    // 2️⃣ بررسی مالک بودن
    if ($user->id === $book->library->user_id) {
        return back()->with('error', 'شما مالک این کتابخانه هستید و نمی‌توانید کتاب خود را امانت بگیرید.');
    }

    // 3️⃣ جلوگیری از امانت تکراری
    $alreadyBorrowed = Borrowing::where('user_id', $user->id)
                                ->where('book_id', $book->id)
                                ->whereNull('returned_at')
                                ->exists();

    if ($alreadyBorrowed) {
        return back()->with('error', 'شما قبلاً این کتاب را امانت گرفته‌اید.');
    }

    // 4️⃣ ثبت امانت
    $borrowing = Borrowing::create([
        'user_id' => $user->id,
        'book_id' => $book->id,
        'borrowed_at' => now(),
        'due_date' => now()->addDays(14), // 2 هفته
    ]);

    // 5️⃣ کم کردن موجودی کتاب
    $book->decrement('quantity');

    // 6️⃣ هدایت به صفحه فرم ارسال و پرداخت
    return redirect()->route('borrowings.checkout', $borrowing->id)
                     ->with('success', 'کتاب با موفقیت رزرو شد. لطفاً اطلاعات ارسال را تکمیل کنید.');
}


}
