<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Controllers\Admin\NewsController;
    use App\Http\Controllers\Admin\GalleryController;
    use App\Http\Controllers\Admin\ServiceController;

    // Frontend Routes
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/berita', [App\Http\Controllers\HomeController::class, 'news'])->name('news');
    Route::get('/berita/{slug}', [App\Http\Controllers\HomeController::class, 'newsDetail'])->name('news.detail');
    Route::get('/galeri', [App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');
        
        Route::middleware(['auth'])->group(function () {
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
            Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout.get');
            
            // Resource Routes
            Route::resource('news', NewsController::class);
            Route::resource('gallery', GalleryController::class);
            Route::resource('services', ServiceController::class);
        });
    });
