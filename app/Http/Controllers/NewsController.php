<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of published news articles.
     */
    public function index()
    {
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(6)
            ->get();

        $featuredArticle = News::published()
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->first();
        
        $randomNews = News::published()
            ->whereNotIn('id', $news->pluck('id'))
            ->where('id', '!=', $featuredArticle->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.home', compact('news', 'featuredArticle', 'randomNews'));
    }

    /**
     * Display the specified news article.
     */
    public function show($slug)
    {
        $article = News::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Get other recent articles for "Read More Articles" section
        $otherArticles = News::published()
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('pages.article', compact('article', 'otherArticles'));
    }

    /**
     * Get all published news articles as JSON (for API usage if needed)
     */
    public function api()
    {
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($news);
    }
}
