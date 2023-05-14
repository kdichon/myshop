<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [ProductController::class, 'index'])->name('home');

//Filtre par catégorie
Route::get('/filtre/{id}', [ProductController::class, 'index'])->name('home.category');

//Route détail 
Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('home.detail');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ne peut ajouter au panier, que les utilisateurs connectés
    Route::get('/addtocart/{product}', [CartController::class, 'add'])->name('addtocart');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
});

require __DIR__ . '/auth.php';
