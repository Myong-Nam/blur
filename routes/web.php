<?php

use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\ProfileController;
use App\Livewire\EditExhibition;
use Illuminate\Support\Facades\Artisan;
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
    return view('index');
})->name('index');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "all cleared ...";

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/exhibition/create', [ExhibitionController::class, 'create'])->name('create');
    Route::get('/exhibition/{exhibitionId}/edit/', EditExhibition::class)->name('exhibition.edit');
    Route::post('/exhibition/store', [ExhibitionController::class, 'store']);
    Route::delete('/exhibition/{exhibition}/', [ExhibitionController::class, 'destroy'])->name('exhibition.destroy');
    Route::get('/myexhibitions/manage', [ExhibitionController::class, 'manage']);
});

Route::get('/exhibition/{exhibition}', [ExhibitionController::class, 'show'])->name('exhibition.show');

require __DIR__ . '/auth.php';
