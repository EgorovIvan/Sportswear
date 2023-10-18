<?php


declare(strict_types=1);

use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [HomeController::class, 'index'])
    ->name('main.index');

Route::group(['middleware' => 'auth'], static function () {

    Route::group(['prefix' => 'account'], static function () {
        Route::get('/', AccountController::class)->name('account');
    });

    // Admin
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'check.admin',

    ], static function () {
        Route::get('/', AdminController::class)
            ->name('index');
        Route::resource('/catalog', AdminCatalogController::class);
    });
});

Route::get('/catalog', [CatalogController::class, 'index'])
    ->name('catalog.index');

Route::get('/catalog/filter', [CatalogController::class, 'showFilter'])
    ->name('catalog.filter');

Route::get('/catalog/search', [CatalogController::class, 'showSearch'])
    ->name('catalog.search');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::put('/cart/add_quantity/{id}', [CartController::class, 'addQuantity'])
    ->name('cart.addQuantity');

Route::put('/cart/reduce_quantity/{id}', [CartController::class, 'reduceQuantity'])
    ->name('cart.reduceQuantity');

Route::post('/cart/add/{id}', [CartController::class, 'add'])
    ->where('id', '[0-9]+')
    ->name('cart.add');

Route::delete('/cart/{id}', [CartController::class, 'destroy'])
    ->name('cart.destroy');

Route::get('/sessions', function () {

    if (session()->has('mysession')) {
        dd(session()->all(), session()->get('mysession'));
        session()->forget('mysession');
    }

    session()->put('mysession', 'Test session');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

