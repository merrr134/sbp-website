<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->paginate(6);
        return view('public.news.index', compact('news'));
    }

    public function show(string $slug)
    {
        $news = News::where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();

        $prev = News::published()
                    ->where('id', '<', $news->id)
                    ->first();

        $next = News::published()
                    ->where('id', '>', $news->id)
                    ->orderBy('id', 'asc')
                    ->first();

        return view('public.news.show', compact('news', 'prev', 'next'));
    }
}
