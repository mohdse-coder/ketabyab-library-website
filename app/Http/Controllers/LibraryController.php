<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; // این حتما باید باشه

/**
 * کلاس کنترلر کتابخانه‌ها
 *
 * @extends Controller
 */
class LibraryController extends Controller
{
    /**
     * اعمال middleware برای احراز هویت
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * نمایش لیست کتابخانه‌های کاربر
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $libraries = $user->libraries()->get();

        return view('libraries.index', compact('libraries'));
    }

    /**
     * فرم ایجاد کتابخانه جدید
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $plan = $user->activePlan();

        $libraryCount = $user->libraries()->count();

        // بررسی سقف کتابخانه‌ها
        if ($libraryCount >= $plan->max_libraries) {
            return redirect()->route('user_dashboard')
                             ->with('error', 'شما به سقف تعداد کتابخانه‌های مجاز خود رسیده‌اید.');
        }

        return view('libraries.create');
    }

    /**
     * ذخیره کتابخانه جدید
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $plan = $user->activePlan();

        // محدودیت تعداد کتابخانه
        if ($user->libraries()->count() >= $plan->max_libraries) {
            return back()->withErrors(['plan' => 'سقف مجاز کتابخانه‌های شما پر شده است.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'privacy' => 'required|in:public,private',
        ]);

        $library = Library::create([
            'name' => $request->name,
            'description' => $request->description,
            'privacy' => $request->privacy,
            'user_id' => $user->id,
            'cover' => $request->hasFile('cover')
                        ? $request->file('cover')->store('covers', 'public')
                        : null,
        ]);

        return redirect()->route('libraries.show', $library->id)
                         ->with('success', 'کتابخانه با موفقیت ایجاد شد');
    }

    /**
     * نمایش جزئیات یک کتابخانه
     */
    public function show(Library $library)
    {
        $library->load('books');

        return view('libraries.show', [
            'library' => $library,
            'books' => $library->books
        ]);
    }

    /**
     * فرم ویرایش کتابخانه
     */
    public function edit(Library $library)
    {
        if ($library->user_id !== Auth::id()) {
            abort(403);
        }

        return view('libraries.edit', compact('library'));
    }

    /**
     * بروزرسانی کتابخانه
     */
    public function update(Request $request, Library $library)
    {
        if ($library->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'privacy' => 'required|in:public,private',
        ]);

        if ($request->hasFile('cover')) {
            if ($library->cover) {
                Storage::disk('public')->delete($library->cover);
            }
            $library->cover = $request->file('cover')->store('covers', 'public');
        }

        $library->update([
            'name' => $request->name,
            'description' => $request->description,
            'privacy' => $request->privacy,
        ]);

        return redirect()->route('libraries.index')
                         ->with('success', 'کتابخانه با موفقیت ویرایش شد!');
    }

    /**
     * حذف کتابخانه
     */
    public function destroy(Library $library)
    {
        if ($library->user_id !== Auth::id()) {
            abort(403);
        }

        if ($library->cover) {
            Storage::disk('public')->delete($library->cover);
        }

        $library->delete();

        return redirect()->route('libraries.index')
                         ->with('success', 'کتابخانه با موفقیت حذف شد!');
    }
}
