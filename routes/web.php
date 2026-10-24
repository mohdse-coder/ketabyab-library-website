<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

/*
|--------------------------------------------------------------------------
| صفحات عمومی
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn () => view('about'))->name('about');
Route::get('/call_us', fn () => view('call_us'))->name('call_us');
Route::get('/gavanin', fn () => view('gavanin'))->name('gavanin');
Route::get('/your_Question', fn () => view('your_Question'))->name('your_Question');

/*
|--------------------------------------------------------------------------
| جستجو (عمومی)
|--------------------------------------------------------------------------
*/
Route::match(['get','post'], '/search', [SearchController::class,'index'])->name('search');

/*
|--------------------------------------------------------------------------
| احراز هویت کاربران عادی
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login'])->name('login.submit');

Route::post('/logout', function(){
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

/*
|--------------------------------------------------------------------------
| مسیرهای نیازمند لاگین
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function(){

    // داشبورد کاربر
    Route::get('/user_dashboard', fn()=>view('user_dashboard'))->name('user_dashboard');

    // کتابخانه‌ها با resource (ایجاد، ذخیره، ویرایش، حذف، مشاهده)
    Route::resource('libraries', LibraryController::class);

    // کتاب‌ها (مالک کتابخانه)
    Route::get('/libraries/{library}/books/create', [BookController::class,'create'])->name('books.create');
    Route::post('/libraries/{library}/books', [BookController::class,'store'])->name('books.store');
    Route::get('/libraries/{library}/books/{book}/edit', [BookController::class,'edit'])->name('books.edit');
    Route::put('/libraries/{library}/books/{book}', [BookController::class,'update'])->name('books.update');
    Route::delete('/libraries/{library}/books/{book}', [BookController::class,'destroy'])->name('books.destroy');

    // امانت گرفتن کتاب
    Route::post('/books/{book}/borrow', [BookController::class,'borrow'])->name('books.borrow');

});

/*
|--------------------------------------------------------------------------
| مسیرهای عمومی کتابخانه و کتاب
|--------------------------------------------------------------------------
*/
Route::get('/books/{book}', [BookController::class,'show'])->name('books.show');



/*
|--------------------------------------------------------------------------
| مسیرهای ادمین
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function() {
    Route::get('/user/orders', [App\Http\Controllers\OrderController::class, 'history'])->name('user.history');
});



use App\Http\Controllers\PlanController;

Route::middleware('auth')->group(function() {
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/plans/{plan}/upgrade', [PlanController::class, 'upgrade'])->name('plans.upgrade');
});


Route::post('/plans/{plan}/upgrade', [PlanController::class, 'upgrade'])
    ->name('plans.upgrade');


Route::get('/search', [SearchController::class, 'index'])->name('search');


Route::middleware('auth')->group(function () {

    // صفحه تاریخچه کاربر
    Route::get('/user/orders', [App\Http\Controllers\OrderController::class, 'history'])->name('user.history');

    // صفحات پلن
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/plans/{plan}/upgrade', [PlanController::class, 'upgrade'])->name('plans.upgrade');

    // امانت کتاب و فرم ارسال/پرداخت
    Route::get('/borrowings/{borrowing}/checkout', [BorrowingController::class, 'checkout'])
         ->name('borrowings.checkout');

    Route::post('/borrowings/{borrowing}/checkout', [BorrowingController::class, 'processCheckout'])
         ->name('borrowings.checkout.process');
});

