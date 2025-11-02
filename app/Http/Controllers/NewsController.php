<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    protected $log;

    public function __construct()
    {
        $this->log = Log::channel('news');
    }

    /**
     * Display all published news articles with pagination.
     */
    public function allArticles(Request $request)
    {
        try {
            $query = News::published()
                ->with('category')
                ->orderBy('published_at', 'desc')
                ->orderBy('created_at', 'desc');
    
            if ($request->has('category') && $request->category) {
                $query->where('category_id', $request->category);
            }
    
            $articles = $query->paginate(12);
            
            $categories = Category::active()->orderBy('name')->get();
        } catch (\Exception $e) {
            $this->log->error($e);
        }

        return view('pages.articles', compact('articles', 'categories'));
    }

    /**
     * Display a listing of published news articles.
     */
    public function index()
    {
        try {
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
                ->where('id', '!=', $featuredArticle?->id)
                ->inRandomOrder()
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            $this->log->error($e);
        }

        return view('pages.home', compact('news', 'featuredArticle', 'randomNews'));
    }

    /**
     * Display the specified news article.
     */
    public function show($slug)
    {
        try {
            $article = News::published()
                ->where('slug', $slug)
                ->firstOrFail();

            $relatedArticles = News::published()
                ->where('id', '!=', $article->id)
                ->orderBy('published_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get();
        } catch (\Exception $e) {
            $this->log->error($e);
        }

        return view('pages.article', compact('article', 'relatedArticles'));
    }

    /**
     * Get all published news articles as JSON (for API usage if needed)
     */
    public function api()
    {
        try {
            $news = News::published()
                ->orderBy('published_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $this->log->error($e);
        }

        return response()->json($news);
    }

    /**
     * Get random news articles as JSON (for AJAX requests)
     */
    public function randomNews(Request $request)
    {
        try {
            $topNewsIds = News::published()
                ->orderBy('published_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->take(7)
                ->pluck('id')->toArray();
            
            $excludeIds = [];
            if ($request->has('exclude')) {
                $excludeIds = explode(',', $request->get('exclude'));
                $excludeIds = array_filter($excludeIds, 'is_numeric');
            }
            
            $allExcludeIds = array_merge($topNewsIds, $excludeIds);
            
            $randomNews = News::published()
                ->whereNotIn('id', $allExcludeIds)
                ->inRandomOrder()
                ->take(3)
                ->get();

            $randomNews->each(function ($article) {
                $article->published_at_human = $article->published_at->diffForHumans();
            });
        } catch (\Exception $e) {
            $this->log->error($e);
        }

        return response()->json($randomNews);
    }

    /**
     * Get related articles for a specific article (for AJAX requests)
     */
    public function relatedArticles(Request $request, $slug)
    {
        try {
            $article = News::published()
                ->where('slug', $slug)
                ->firstOrFail();

            $excludeIds = [$article->id];

            if ($request->has('exclude')) {
                $previousIds = explode(',', $request->get('exclude'));
                $previousIds = array_filter($previousIds, 'is_numeric');
                $excludeIds = array_merge($excludeIds, $previousIds);
            }

            $relatedArticles = News::published()
                ->whereNotIn('id', $excludeIds)
                ->inRandomOrder()
                ->limit(4)
                ->get();
            
            $relatedArticles->each(function ($article) {
                $article->published_at_human = $article->published_at->diffForHumans();
            });
        } catch (\Exception $e) {
            $this->log->error($e);
        }

        return response()->json($relatedArticles);
    }

    /**
     * Get bottom headlines for AJAX loading
     */
    public function bottomHeadlines()
    {
        try {
            $latestHeadlines = News::published()
                ->with('category')
                ->orderBy('published_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        } catch (\Exception $e) {
            $this->log->error($e);
        }

        return response(view('includes.bottom-headlines', compact('latestHeadlines'))->render())->header('Content-Type', 'text/html');
    }

    /**
     * Run database seeder
     */
    public function runSeed()
    {
        try {
            Artisan::call('db:seed');
            return redirect()->back()->with('success', 'Database seeded successfully!');
        } catch (\Exception $e) {
            $this->log->error($e);
            return redirect()->back()->with('error', 'Failed to seed database: ' . $e->getMessage());
        }
    }
}
