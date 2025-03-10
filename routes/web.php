<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseController;
use App\Http\Model\Category;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/test', function() {
    return view('test');
});
Route::get('/ownerHome', function() {
    return view('/ownerHome');
});
Route::post('/houses/create', [HouseController::class, 'store'])->name('houses.create');
Route::get('/test/{param}' , [HouseController::class, 'index']);
Route::get('/houses/homeUser', [HouseController::class, 'base']);
Route::post('/houses/search', [HouseController::class, 'search']);





require __DIR__.'/auth.php';
