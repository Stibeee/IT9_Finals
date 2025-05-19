<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\PaymentController;


route::get( '/', [HomeController::class, 'my_home']);

route::get('/home', [HomeController::class, 'index']);

Route::get('add_food', [AdminController::class, 'add_food'])->name('admin.add_food');
Route::post('upload_food', [AdminController::class, 'upload_food'])->name('admin.upload_food');
Route::get('view_food', [AdminController::class, 'view_food'])->name('admin.view_food');
Route::get('delete_food/{id}', [AdminController::class, 'delete_food'])->name('admin.delete_food');
Route::get('update_food/{id}', [AdminController::class, 'update_food'])->name('admin.update_food');
Route::post('edit_food/{id}', [AdminController::class, 'edit_food'])->name('admin.edit_food');
Route::get('availability_food', [AdminController::class, 'availability_food'])->name('admin.availability_food');
Route::get('/toggle_food_availability/{id}', [AdminController::class, 'toggle_food_availability'])->name('admin.toggle_food_availability');
Route::get('promo_food', [AdminController::class, 'promo_food'])->name('admin.promo_food');
Route::post('/toggle-promo/{id}', [AdminController::class, 'togglePromo'])->name('admin.toggle_promo');

Route::get('/add_coffee', [AdminController::class, 'add_coffee'])->name('admin.add_coffee');

Route::post('/upload_coffee', [AdminController::class, 'upload_coffee'])->name('admin.upload_coffee');

Route::get('/view_coffee', [AdminController::class, 'view_coffee'])->name('admin.view_coffee');

Route::get('/delete_coffee/{id}', [AdminController::class, 'delete_coffee'])->name('admin.delete_coffee');

Route::get('/update_coffee/{id}', [AdminController::class, 'update_coffee'])->name('admin.update_coffee');

Route::post('/edit_coffee/{id}', [AdminController::class, 'edit_coffee'])->name('admin.edit_coffee');

Route::get('/availability', [AdminController::class, 'availability_coffee'])->name('admin.availability_coffee');

Route::get('/toggle-coffee/{id}', [AdminController::class, 'toggle_coffee_availability'])->name('admin.toggle_coffee');

Route::get('/transactions', [AdminController::class, 'transactionList'])->name('admin.transactions');

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');

Route::get('/my_cart', [HomeController::class, 'my_cart'])->name('my_cart');

route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

Route::get('/add_stock', [AdminController::class, 'addStock'])->name('admin.add_stock');

Route::get('/view_stock', [AdminController::class, 'viewStock'])->name('admin.view_stock');

Route::post('/store_stock', [AdminController::class, 'storeStock'])->name('admin.store_stock');

Route::get('/stock_history', [AdminController::class, 'stockHistory'])->name('admin.stock_history');

Route::get('/delete_stock/{id}', [AdminController::class, 'deleteStock'])->name('admin.delete_stock');

Route::get('/update_stock/{id}', [AdminController::class, 'updateStock'])->name('admin.update_stock');

Route::post('/edit_stock/{id}', [AdminController::class, 'editStock'])->name('admin.edit_stock');

Route::get('/stock-usage-report', [AdminController::class, 'stockUsageReport'])->name('admin.stock_usage_report');

Route::post('/confirm_order', [HomeController::class, 'confirm_order'])->name('confirm_order');

Route::get('/orders', [AdminController::class, 'orders']);

route::get('on_the_way/{id}', [AdminController::class, 'on_the_way']);

route::get('delivered/{id}', [AdminController::class, 'delivered']);

route::get('canceled/{id}', [AdminController::class, 'canceled']);

Route::get('/sales', [AdminController::class, 'sales'])->name('admin.sales');

Route::get('/my_orders', [HomeController::class, 'my_orders'])->name('my_orders');

Route::middleware(['auth'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/history', [PaymentController::class, 'paymentHistory'])->name('payment.history');
    Route::post('/payment/{payment}/refund', [PaymentController::class, 'refundPayment'])->name('payment.refund');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
