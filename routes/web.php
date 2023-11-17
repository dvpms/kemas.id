<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ImagesController;
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
        Route::get('/slideshow', [ImagesController::class, 'index_slideshow'])->name('index_slideshow');
        Route::post('/slideshow/store', [ImagesController::class, 'store_slideshow'])->name('store_slideshow');
        Route::delete('/delete/{id}', [ImagesController::class, 'destroy_slideshow'])->name('destroy_slideshow');
        Route::post('/status/{id}', [ImagesController::class, 'status_slideshow'])->name('status_slideshow');

        Route::get('index/gallery', [ImagesController::class, 'index_gallery'])->name('index_gallery');


        Route::get('pelelangan/detail/{uuid}', [ImagesController::class, 'detail_list'])->name('detail');
        Route::get('pelelangan/create', [ImagesController::class, 'create_list'])->name('create');
        Route::post('pelelangan/store', [ImagesController::class, 'store_list'])->name('store');
        Route::delete('pelelangan/delete/{id}', [ImagesController::class, 'destroy_list'])->name('destroy');
        Route::post('pelelangan/update', [ImagesController::class, 'update_list'])->name('update');
        Route::post('pelelangan/aktif/{id}', [ImagesController::class, 'aktif_list'])->name('aktif');
        Route::post('pelelangan/nonaktif/{id}', [ImagesController::class, 'nonaktif_list'])->name('nonaktif');
        Route::post('pelelangan/tahap/{tahap}/{id}', [ImagesController::class, 'tahap_list'])->name('tahap');
        Route::post('pelelangan/win/{uuid}/{id}', [ImagesController::class, 'pemenang'])->name('pemenang');
        Route::post('pelelangan/win/{uuid}', [ImagesController::class, 'pemenang_skp'])->name('pemenang_skp');
        Route::post('pelelangan/cancel/{uuid}/{id}', [ImagesController::class, 'batal_pemenang'])->name('batal_pemenang');
    });
});
