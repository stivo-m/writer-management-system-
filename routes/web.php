<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\MoneyController;


// writers
use App\Http\Controllers\Writers\DashboardController;

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
    return view('welcome');
});

Route::group(
    [
        'prefix' => 'admin',
        "middleware" => [
            'auth:sanctum',
            'role:admin',
        ],
        'verified',
       
    ],

     function(){

            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
            Route::get('/settings', function () {
                return view('settings');
            })->name('settings');
            
            //users
            Route::get('/users', [UsersController::class, 'index'])->name('users');
            Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
            Route::post('/users/add', [UsersController::class, 'add'])->name('users.add');
       

            // order functions
            Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
            Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('order.show');
            Route::post('/orders/add', [OrdersController::class, 'add'])->name('order.add');
            Route::post('/orders/assign/{order}', [OrdersController::class, 'assign'])->name('order.assign');
            Route::post('/orders/approve/{order}', [OrdersController::class, 'approve'])->name('order.approve');
            Route::post('/orders/revision/{order}', [OrdersController::class, 'revision'])->name('order.revision');
            Route::post('/orders/dispute/{order}', [OrdersController::class, 'dispute'])->name('order.dispute');
            Route::post('/orders/finish/{order}', [OrdersController::class, 'finish'])->name('order.finish');
            Route::post('/orders/reassign/{order}', [OrdersController::class, 'reassign'])->name('order.reassign');
            Route::post('/orders/upload/{order}', [OrdersController::class, 'uploadFiles'])->name('order.upload');
            Route::get('/orders/download/{file}', [OrdersController::class, 'download'])->name('download');

            // invoices
            Route::get('/money', [MoneyController::class, 'index'])->name('money.invoice');
            Route::get('/money/{invoice}', [MoneyController::class, 'invoiceList'])->name('money.invoice.list');
            Route::post('/money/pay/{invoice}', [MoneyController::class, 'payInvoice'])->name('money.pay.all');
        }
    );


// writer
Route::group(
    [
        'prefix' => 'writer',
        'middleware' => [
            'auth:sanctum',
            'role:writer',
        ],
        'verified',

    ],
    function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('writer.dashboard');
        // orders
        Route::get('/order', [DashboardController::class, 'orders'])->name('writer.orders');
        Route::get('/order/{order}', [DashboardController::class, 'orderShow'])->name('writer.orders.show');
        Route::post('/order/{order}', [DashboardController::class, 'completeOrder'])->name('writer.orders.complete');
        Route::post('/order/take/{order}', [DashboardController::class, 'takeOrder'])->name('writer.orders.take');
        Route::get('/order/download/{file}', [DashboardController::class, 'download'])->name('writer.download');

        // money
        Route::get('/money', [DashboardController::class, 'money'])->name('writer.money');
        Route::get('/money/{invoice}', [DashboardController::class, 'fullInvoice'])->name('writer.money.list');
        // settings
        Route::get('/profile', [DashboardController::class, 'profile'])->name('writer.profile.show');
    }
);