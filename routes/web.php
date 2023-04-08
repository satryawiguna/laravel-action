<?php

use App\Http\Controllers\Profile\DestroyProfile;
use App\Http\Controllers\Profile\EditProfile;
use App\Http\Controllers\Profile\UpdateProfile;
use App\Http\Controllers\Weather\ViewWeather;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile', EditProfile::class)->name('profile.edit');
    Route::patch('/profile', UpdateProfile::class)->name('profile.update');
    Route::delete('/profile', DestroyProfile::class)->name('profile.destroy');

    Route::get('/weather', ViewWeather::class)->name('weather');
});

require __DIR__.'/auth.php';
