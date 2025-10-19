<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/news', [NewsController::class, 'api'])->name('api.news');
Route::get('/random-news', [NewsController::class, 'randomNews'])->name('api.random-news');
Route::get('/related-articles/{slug}', [NewsController::class, 'relatedArticles'])->name('api.related-articles');