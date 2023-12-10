<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\HomeController;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__ . '/frontend/');
});

Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
    Route::get('galeri', [HomeController::class, 'index_galeri'])->name('index_galeri');
    Route::get('berita', [HomeController::class, 'index_berita'])->name('index_berita');
    Route::get('berita/{sumber}/{kategori}', [HomeController::class, 'index_berita_kategori'])->name('index_berita_kategori');
    Route::get('tentang', [HomeController::class, 'index_tentang'])->name('index_tentang');

    Route::get('keluarga', [HomeController::class, 'index_keluarga'])->name('index_keluarga');
    Route::delete('keluarga/delete/{id}', [HomeController::class, 'destroy_keluarga'])->name('destroy_keluarga');

    Route::get('surat', [HomeController::class, 'index_surat'])->name('index_surat');
    Route::get('surat/{jenis}', [HomeController::class, 'add_surat'])->name('add_surat');
    Route::get('generate/surat/{jenis}/{uuid}', [HomeController::class, 'generate_surat'])->name('generate_surat');
    Route::post('surat/store/{jenis}', [HomeController::class, 'store_surat'])->name('store_surat');

    Route::get('pengajuan', [HomeController::class, 'index_pengajuan'])->name('index_pengajuan');
    Route::delete('pengajuan/delete/{uuid}', [HomeController::class, 'delete_pengajuan'])->name('delete_pengajuan');

    Route::post('message/store', [HomeController::class, 'store_message'])->name('store_message');
});
/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__ . '/backend/');
});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'images', 'as' => 'images.'], function () {
        Route::get('slideshow', [ImagesController::class, 'index_slideshow'])->name('index_slideshow');
        Route::post('slideshow/store', [ImagesController::class, 'store_slideshow'])->name('store_slideshow');
        Route::delete('slideshow/delete/{id}', [ImagesController::class, 'destroy_slideshow'])->name('destroy_slideshow');
        Route::post('slideshow/status/{id}', [ImagesController::class, 'status_slideshow'])->name('status_slideshow');

        Route::get('gallery', [ImagesController::class, 'index_gallery'])->name('index_gallery');
        Route::post('gallery/store', [ImagesController::class, 'store_gallery'])->name('store_gallery');
        Route::delete('gallery/delete/{id}', [ImagesController::class, 'destroy_gallery'])->name('destroy_gallery');
    });
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('news', [AdminController::class, 'index_news'])->name('index_news');
        Route::post('news/store', [AdminController::class, 'store_news'])->name('store_news');
        Route::get('news/edit/{id}', [AdminController::class, 'edit_news'])->name('edit_news');
        Route::post('news/update/{id}', [AdminController::class, 'update_news'])->name('update_news');
        Route::delete('news/delete/{id}', [AdminController::class, 'destroy_news'])->name('destroy_news');

        Route::get('announce', [AdminController::class, 'index_announce'])->name('index_announce');
        Route::post('announce/store', [AdminController::class, 'store_announce'])->name('store_announce');
        Route::get('announce/edit/{id}', [AdminController::class, 'edit_announce'])->name('edit_announce');
        Route::post('announce/update/{id}', [AdminController::class, 'update_announce'])->name('update_announce');
        Route::delete('announce/delete/{id}', [AdminController::class, 'destroy_announce'])->name('destroy_announce');

        Route::get('approval', [AdminController::class, 'index_approval'])->name('index_approval');
        Route::get('approval/list', [AdminController::class, 'list_approval'])->name('list_approval');
        Route::post('approval/approve/{id}', [AdminController::class, 'approve_approval'])->name('approve_approval');
        Route::post('approval/reject/{id}', [AdminController::class, 'reject_approval'])->name('reject_approval');
        Route::post('approval/reset/{id}', [AdminController::class, 'reset_approval'])->name('reset_approval');
        Route::delete('approval/delete/{id}', [AdminController::class, 'destroy_approval'])->name('destroy_approval');

        Route::get('warga', [AdminController::class, 'index_warga'])->name('index_warga');
        Route::post('warga/store', [AdminController::class, 'store_warga'])->name('store_warga');
        Route::get('warga/edit/{id}', [AdminController::class, 'edit_warga'])->name('edit_warga');
        Route::post('warga/update/{id}', [AdminController::class, 'update_warga'])->name('update_warga');
        Route::delete('warga/delete/{id}', [AdminController::class, 'destroy_warga'])->name('destroy_warga');
        Route::get('warga/view/{kk}', [AdminController::class, 'view_warga'])->name('view_warga');
        Route::post('warga/add', [AdminController::class, 'add_warga'])->name('add_warga');
        Route::get('warga/find', [AdminController::class, 'find_warga'])->name('find_warga');

        Route::get('inbox', [AdminController::class, 'index_inbox'])->name('index_inbox');
    });
});
