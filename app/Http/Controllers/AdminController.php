<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ConsentRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalConsents = ConsentRecord::count();
        $totalArticles = News::count();
        $recentConsents = ConsentRecord::latest()->take(5)->get();
        $recentArticles = News::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalConsents', 'totalArticles', 'recentConsents', 'recentArticles'));
    }

    public function consents()
    {
        $records = ConsentRecord::latest()->paginate(15);
        return view('admin.consents', compact('records'));
    }

    public function articles()
    {
        $articles = News::latest()->paginate(15);
        return view('admin.articles', compact('articles'));
    }

    public function editArticle($id)
    {
        $article = News::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'nullable|string|max:500',
                'text' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
                'remove_image' => 'nullable|boolean',
                'is_featured' => 'boolean'
            ]);

            $article = News::findOrFail($id);
            
            // Handle image upload and removal
            $imagePath = $article->image; // Keep existing image by default
            
            // Check if user wants to remove the current image
            if ($request->boolean('remove_image')) {
                // Delete the old image file if it exists
                if ($article->image && file_exists(public_path($article->image))) {
                    unlink(public_path($article->image));
                }
                $imagePath = null;
            }
            
            // Handle new image upload
            if ($request->hasFile('image')) {
                // Delete the old image file if it exists
                if ($article->image && file_exists(public_path($article->image))) {
                    unlink(public_path($article->image));
                }
                
                // Store the new image
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('img'), $imageName);
                $imagePath = 'img/' . $imageName;
            }
            
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'text' => $request->text,
                'image' => $imagePath,
                'is_featured' => $request->boolean('is_featured')
            ]);

            return redirect()->route('admin.articles')->with('success', 'Article updated successfully');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update article: ' . $e->getMessage())->withInput();
        }
    }

    public function createArticle()
    {
        return view('admin.articles.create');
    }

    public function storeArticle(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'content' => 'nullable|string|max:500',
                'text' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
                'is_featured' => 'boolean'
            ]);

            $imagePath = null;
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('img'), $imageName);
                $imagePath = 'img/' . $imageName;
            }
            
            News::create([
                'title' => $request->title,
                'author' => $request->author,
                'content' => $request->content,
                'text' => $request->text,
                'image' => $imagePath,
                'is_featured' => $request->boolean('is_featured'),
                'slug' => Str::slug($request->title),
                'published_at' => now(),
                'read_minutes' => max(1, ceil(str_word_count(strip_tags($request->text)) / 200))
            ]);

            return redirect()->route('admin.articles')->with('success', 'Article created successfully');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create article: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteArticle($id): JsonResponse
    {
        try {
            $article = News::findOrFail($id);
            $article->delete();

            return response()->json([
                'success' => true,
                'message' => 'Article deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete article: ' . $e->getMessage()
            ], 500);
        }
    }
}
