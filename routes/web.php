<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/homepage'));
Route::get('/en', fn () => redirect('/en/homepage'));

Route::get('/homepage', [SiteController::class, 'index'])->defaults('locale', 'id');
Route::get('/en/homepage', [SiteController::class, 'index'])->defaults('locale', 'en');

Route::get('/about', [SiteController::class, 'about'])->defaults('locale', 'id');
Route::get('/en/about', [SiteController::class, 'about'])->defaults('locale', 'en');

Route::get('/news/{widget}/{position}', [SiteController::class, 'newsDetail'])->defaults('locale', 'id');
Route::get('/en/news/{widget}/{position}', [SiteController::class, 'newsDetail'])->defaults('locale', 'en');
