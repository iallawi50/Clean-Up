<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Ad;
use App\Models\Order;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return redirect('/ads');
});



Route::resource('/ads', AdController::class);
Route::get('ads/{id}/order', [OrderController::class, 'create']);
Route::post('ads/{id}/order', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'index'])->name('myorders');
Route::patch('/orders/{id}/delete', [OrderController::class, 'update']);
Route::get('/requests', [OrderController::class, "requests"])->name('requests');
Route::patch('/requests/{id}/status', [OrderController::class, 'status']);
Route::get('/myads', function () {
    $ads = Ad::latest()->where('user_id', auth()->user()->id)->latest()->get();
    return view("ads.index", compact('ads'));
});
