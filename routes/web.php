<?php

use App\Models\Order;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

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

// Rotta homepage per guest
Route::get('/', 'HomeController@index')->name('homepage');

// Rotta per lo show del singolo ristorante
Route::get('/restaurants/{restaurant:slug}', 'RestaurantController@show')->name(
    'restaurant'
);

// Rotte per il checkout
Route::get('/checkout', 'OrderController@checkout')->name('checkout');
Route::post('/checkout', 'OrderController@store')->name('store');

// Rotte per l'autenticazione dell'utente
Auth::routes();

// Rotte per gli utenti registrati (admin)
Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        // Rotta per la dashboard dell'admin
        Route::get('/', 'HomeController@index')->name('dashboard');

        // Rotta per la creazione del primo Ristorante
        Route::resource('/register', 'FirstRestaurantController')->only(
            'create',
            'store'
        );

        //Rotta per la gestione del ristorante (CRUD)
        Route::resource('/restaurants', RestaurantController::class);

        //Rotta per la gestione dei prodotto/piatti (CRUD)
        Route::resource('/products', ProductController::class)->except([
            'create',
        ]);
        Route::get(
            '/products/create/{restaurant}',
            'ProductController@create'
        )->name('product.create');

        Route::get('/restaurants/orders/{restaurant:id}', 'OrderController@show')->name('order.index');
        Route::get('/restaurants/orders/chart/{restaurant:id}', 'OrderController@chart')->name('order.chart');
    });
