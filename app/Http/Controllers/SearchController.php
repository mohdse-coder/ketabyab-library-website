<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Library;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('search'));

        // جستجو در جدول کتاب‌ها
        $books = Book::whereRaw('TRIM(title) = ?', [$query])
             ->orWhere('title', 'like', "% {$query}")
             ->orWhere('title', 'like', "%{$query} %")
             ->orWhere('title', 'like', "%{$query}%")
             ->with('library')
             ->get();



        return view('search.results', compact('books', 'query'));


    }
}
