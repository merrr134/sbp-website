<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\AssetController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeSettingController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\AssetController as AdminAssetController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switcher
Route::get('/lang/{lang}', function ($lang) {
    if (in_array($lang, ['id', 'en', 'zh'])) {
        session(['lang' => $lang]);
    }
    return redirect()->back();
})->name('lang.switch');

// Tentang Kami
Route::prefix('tentang')->name('about.')->group(function () {
    Route::get('/perusahaan', [AboutController::class, 'company'])->name('company');
    Route::get('/visi-misi',  [AboutController::class, 'visionMission'])->name('vision-mission');
    Route::get('/sejarah',    [AboutController::class, 'history'])->name('history');
    Route::get('/aset',       [AssetController::class, 'index'])->name('assets');
    Route::get('/aset/{slug}',[AssetController::class, 'show'])->name('assets.show');
});

// Berita
Route::prefix('berita')->name('news.')->group(function () {
    Route::get('/',       [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Galeri
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Kontak
Route::get('/kontak',  [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Home
    Route::get('/home', [HomeSettingController::class, 'edit'])->name('home.edit');
    Route::put('/home', [HomeSettingController::class, 'update'])->name('home.update');

    // Kelola Tentang Kami
    Route::get('/tentang', [AdminAboutController::class, 'edit'])->name('about.edit');
    Route::put('/tentang', [AdminAboutController::class, 'update'])->name('about.update');

    // Kelola Berita
    Route::resource('berita', AdminNewsController::class)
         ->except(['show'])
         ->parameters(['berita' => 'berita']);

    // Kelola Galeri
    Route::get('/galeri',            [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/galeri',           [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/galeri/{photo}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    // Kelola Mitra
    Route::get('/mitra',              [PartnerController::class, 'index'])->name('partners.index');
    Route::post('/mitra',             [PartnerController::class, 'store'])->name('partners.store');
    Route::delete('/mitra/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');

    // Kelola Aset
    Route::get('/aset',                   [AdminAssetController::class, 'index'])->name('assets.index');
    Route::post('/aset',                  [AdminAssetController::class, 'store'])->name('assets.store');
    Route::get('/aset/{asset}',           [AdminAssetController::class, 'show'])->name('assets.show');
    Route::delete('/aset/{asset}',        [AdminAssetController::class, 'destroy'])->name('assets.destroy');
    Route::post('/aset/{asset}/photos',   [AdminAssetController::class, 'uploadPhotos'])->name('assets.upload-photos');
    Route::delete('/aset/photos/{photo}', [AdminAssetController::class, 'destroyPhoto'])->name('assets.destroy-photo');

    // Pesan
    Route::get('/pesan',              [MessageController::class, 'index'])->name('messages.index');
    Route::get('/pesan/{message}',    [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/pesan/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

});

require __DIR__.'/auth.php';
