<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'bookmarks' => Bookmark::all()->sortByDesc('created_at'),
        ]);
    }
}
