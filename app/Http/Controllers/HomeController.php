<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('home', [
            'bookmarks' => $this->getBookmarks($request),
            'tags' => Tag::all(),
        ]);
    }

    private function getBookmarks(Request $request): Collection
    {
        $tags = $request->tags;
        $searchTerm = $request->search;
        $bookmarks = Bookmark::query();

        if ($tags) {
            $bookmarks = $bookmarks->withAnyTags($tags);
        }

        if ($searchTerm) {
            $bookmarks = $bookmarks->where('title', 'like', '%'.$searchTerm.'%')
                ->orWhere('description', 'like', '%'.$searchTerm.'%');
        }

        return $bookmarks
            ->orderByDesc('created_at')
            ->get();
    }
}
