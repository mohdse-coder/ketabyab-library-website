<?php

namespace App\Http\Controllers;

use App\Models\Library;

class HomeController extends Controller
{
    public function index()
{
    $topLibraries = Library::withCount('books')
        ->orderByDesc('books_count')
        ->take(3)
        ->get();

    return view('index', compact('topLibraries'));
}
}

