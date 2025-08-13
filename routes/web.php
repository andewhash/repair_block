<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contact', function() {
    $contactSettings = App\Models\ContactSetting::first();
    return view('contact', compact('contactSettings'));
})->name('contact');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
// Для заявок
Route::get('/requests/catalog', [RequestController::class, 'catalog'])->name('requests.catalog');
// Для товаров
Route::get('/products/catalog', [ProductController::class, 'catalog'])->name('products.catalog');

Auth::routes();

// Маршруты для аутентифицированных пользователей
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Профиль пользователя
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Заявки пользователя
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::resource('requests', RequestController::class)->except(['show']);
    });

    Route::middleware(['role:supplier'])->group(function() {
        Route::get('/stock/exchange', [RequestController::class, 'exchange'])->name('stock.exchange');
    
        // Мои отклики
        Route::get('/responses', [ResponseController::class, 'index'])->name('responses.index');
        Route::post('/responses/{customerRequest}', [ResponseController::class, 'store'])->name('responses.store');
        Route::put('/responses/{response}', [ResponseController::class, 'update'])->name('responses.update');
    });

    Route::post('/profile/become-supplier', [ProfileController::class, 'becomeSupplier'])->name('profile.become-supplier');
});
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/comment', [BlogCommentController::class, 'store'])->name('blog.comment.store');

// routes/web.php
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
         ->names('admin.users');
         
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class)
        ->except(['show'])
        ->names('admin.blogs');

    Route::get('/import', [\App\Http\Controllers\Admin\UserController::class, 'showImportForm'])->name('admin.users.import');
    Route::post('/import/process', [\App\Http\Controllers\Admin\UserController::class, 'processImport'])->name('admin.users.import.process');
    Route::post('/{user}/approve-supplier', [\App\Http\Controllers\Admin\UserController::class, 'approveSupplier'])
         ->name('admin.users.approve-supplier');
         
    Route::delete('/{user}/reject-supplier', [\App\Http\Controllers\Admin\UserController::class, 'rejectSupplier'])
         ->name('admin.users.reject-supplier');
         
     Route::post('users/{id}/restore', [\App\Http\Controllers\Admin\UserController::class, 'restore'])
         ->name('admin.users.restore');

     Route::resource('cities', \App\Http\Controllers\Admin\CityController::class)
         ->except(['show'])
         ->names('admin.cities');

         Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class)
    ->except(['show'])
    ->names('admin.brands');

     Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)
         ->except(['show'])
         ->names('admin.products');

     Route::get('contact-settings', [\App\Http\Controllers\Admin\ContactSettingController::class, 'edit'])
         ->name('admin.contact-settings.edit');
         
     Route::put('contact-settings', [\App\Http\Controllers\Admin\ContactSettingController::class, 'update'])
         ->name('admin.contact-settings.update');
});