<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Controllers\Admin\NewsController;
    use App\Http\Controllers\Admin\GalleryController;
    use App\Http\Controllers\Admin\ServiceController;
    use App\Http\Controllers\Admin\PotentialController;
    use App\Http\Controllers\HomeController;
    


    // Frontend Routes
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/berita', [App\Http\Controllers\HomeController::class, 'news'])->name('news');
    Route::get('/berita/{slug}', [App\Http\Controllers\HomeController::class, 'newsDetail'])->name('news.detail');
    Route::get('/galeri', [App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');
    Route::get('/potensi/{id}', [App\Http\Controllers\HomeController::class, 'potentialDetail'])->name('potential.detail');
    Route::get('/potensi-desa', [HomeController::class, 'allPotentials'])->name('potential.all');


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
            Route::resource('gallery', GalleryController::class)->except(['show']);
            Route::resource('services', ServiceController::class)->except(['show']);

            


        });

        
    });

    