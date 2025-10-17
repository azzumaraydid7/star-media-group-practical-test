<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsentController;

Route::get('/', [NewsController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/article/{slug}', [NewsController::class, 'show'])->name('article');

Route::get('/api/news', [NewsController::class, 'api'])->name('api.news');

Route::post('/consent/accept', [ConsentController::class, 'accept'])->name('consent.accept');
Route::post('/consent/decline', [ConsentController::class, 'decline'])->name('consent.decline');
Route::post('/consent/validate', [ConsentController::class, 'validate'])->name('consent.validate');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/consents', [AdminController::class, 'consents'])->name('admin.consents');
    Route::put('/admin/consents/{id}', [AdminController::class, 'updateConsent'])->name('admin.consents.update');
    Route::delete('/admin/consents/{id}', [AdminController::class, 'deleteConsent'])->name('admin.consents.delete');
});