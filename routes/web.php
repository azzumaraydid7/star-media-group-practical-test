<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsentController;

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/articles', [NewsController::class, 'allArticles'])->name('articles');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/advertise', function () {
    return view('pages.advertise');
})->name('advertise');

Route::get('/article/{slug}', [NewsController::class, 'show'])->name('article');

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

Route::post('/consent/accept', [ConsentController::class, 'accept'])->name('consent.accept');
Route::post('/consent/decline', [ConsentController::class, 'decline'])->name('consent.decline');
Route::post('/consent/validate', [ConsentController::class, 'validate'])->name('consent.validate');

Route::get('/run-seed', [NewsController::class, 'runSeed'])->name('run.seed');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/consents', [ConsentController::class, 'consents'])->name('admin.consents');
    Route::put('/admin/consents/{id}', [ConsentController::class, 'updateConsent'])->name('admin.consents.update');
    Route::delete('/admin/consents/{id}', [ConsentController::class, 'deleteConsent'])->name('admin.consents.delete');
    Route::get('/admin/articles', [AdminController::class, 'articles'])->name('admin.articles');
    Route::get('/admin/articles/create', [AdminController::class, 'createArticle'])->name('admin.articles.create');
    Route::post('/admin/articles', [AdminController::class, 'storeArticle'])->name('admin.articles.store');
    Route::get('/admin/articles/{id}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');
    Route::put('/admin/articles/{id}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::delete('/admin/articles/{id}', [AdminController::class, 'deleteArticle'])->name('admin.articles.delete');
});

Route::post('/ai/generate-title', [App\Http\Controllers\AiController::class, 'generateTitle'])->name('ai.generate.title');
