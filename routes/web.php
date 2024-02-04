<?php

// Customer
use App\Http\Controllers\Website\About\AboutController;
use App\Http\Controllers\Website\Beranda\BerandaController;
use App\Http\Controllers\Website\Cart\CartController;
use App\Http\Controllers\Website\Customer\PelangganController;
use App\Http\Controllers\Website\Faktur\FakturController;
use App\Http\Controllers\Website\Produk\ProdukController;
use Illuminate\Support\Facades\Route;

// Dashboard Seller
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\RegistrationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Sales\InvoiceController;
use App\Http\Controllers\Dashboard\Sales\OrderController;
use App\Http\Controllers\Dashboard\Account\CustomerController;
use App\Http\Controllers\Dashboard\Profile\ProfileController;
use App\Http\Controllers\Dashboard\Account\UserController;

// Dashboard Super Administrator


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
// Customer Login
Route::prefix( 'buyer' )->group( function () {
    Route::get( 'login', [ PelangganController::class, 'login' ] )->name( 'customer.login' );
    Route::post( 'login', [ PelangganController::class, 'authenticate' ] )->name( 'customer.authenticate' );
    Route::get( 'register', [ PelangganController::class, 'registration' ] )->name( 'customer.register' );
    Route::post( 'register', [ PelangganController::class, 'registering' ] )->name( 'customer.registering' );
    Route::get( 'logout', [ PelangganController::class, 'logout' ] )->name( 'customer.logout' );

} );

// Website
Route::redirect( '/', '/beranda' );
Route::prefix( '/' )->group( function () {
    Route::resource( 'beranda', BerandaController::class);
    Route::resource( 'produk', ProdukController::class);
    Route::resource( 'tentang-kami', AboutController::class);
    // Product

    // Customer
    Route::middleware( 'customer' )->group( function () {
        // Profil
        route::resource( 'pelanggan', PelangganController::class);
        Route::put( 'pelanggan/image/{pelanggan}', [ PelangganController::class, 'updateImages' ] )->name( 'pelanggan.image.update' );
        Route::put( 'pelanggan/password/{pelanggan}', [ PelangganController::class, 'updatePassword' ] )->name( 'pelanggan.password.update' );
        Route::put( 'pelanggan/deactive/{pelanggan}', [ PelangganController::class, 'deactiveAccount' ] )->name( 'pelanggan.deactive-account' );

        // History
        Route::get( 'pelanggan/history/{pelanggan}', [ PelangganController::class, 'history' ] )->name( 'pelanggan.history' );
        Route::get( 'print/{invoice}', [ FakturController::class, 'print' ] )->name( 'print-faktur' );

        // Cart
        Route::resource( 'cart', CartController::class);
        Route::post( 'cart/{cart}/buy', [ CartController::class, 'buyProduct' ] )->name( 'cart.buy' );
        Route::view( '/redirect_with_post', 'redirect_with_post' )->name( 'redirect_with_post' );

        // Whatsapp Send Message
        Route::post( 'cart/{user}/whatsapp', [ CartController::class, 'sendWhatsAppMessage' ] )->name( 'whatsapp.send' );

    } );
} );


// Dashboard
Route::prefix( 'administrator' )->group( function () {
    Route::get( 'login', [ LoginController::class, 'login' ] )->name( 'login' );
    Route::post( 'login', [ LoginController::class, 'authenticate' ] )->name( 'authenticate' );
    Route::get( 'logout', [ LoginController::class, 'logout' ] )->name( 'logout' );
    Route::get( 'register', [ RegistrationController::class, 'registration' ] )->name( 'seller.register' );
    Route::post( 'register', [ RegistrationController::class, 'registering' ] )->name( 'seller.registering' );
    Route::get( 'logout', [ LoginController::class, 'logout' ] )->name( 'logout' );
} );

// Administrator
Route::prefix( 'administrator' )->middleware( [ 'auth' ] )->group( function () {
    Route::get( 'dashboard', [ DashboardController::class, 'index' ] )->name( 'dashboard' );

    // Shop
    Route::prefix( 'sales' )->group( function () {
        // Pesanan
        Route::resource( 'order', OrderController::class);
        Route::post( 'order/{order}/accept', [ OrderController::class, 'negotiatePrice' ] )->name( 'order.negotiate-price' );
        Route::put( 'order/{order}/cancel', [ OrderController::class, 'cancel' ] )->name( 'order.cancel' );
        // Faktur
        Route::resource( 'invoice', InvoiceController::class);
        Route::get( 'print/{invoice}', [ InvoiceController::class, 'print' ] )->name( 'print-invoice' );
    } );

    // Katalog
    Route::prefix( 'catalog' )->group( function () {
        // Selesaikan profil sebelum menambahkan produk
        Route::middleware( 'profile.completed' )->group( function () {
            // produk
            Route::resource( 'product', ProductController::class);
            Route::delete( 'product/{product}/delete-image/{productImage}', [ ProductController::class, 'deleteImage' ] )->name( 'product.delete-image' );
        } );
    } );
    // Profile
    Route::prefix( 'profile' )->group( function () {
        Route::get( '{user}', [ ProfileController::class, 'show' ] )->name( 'profile.show' );
        Route::get( '{user}/edit', [ ProfileController::class, 'edit' ] )->name( 'profile.edit' );
        Route::put( '{user}', [ ProfileController::class, 'update' ] )->name( 'profile.update' );
        Route::put( '{user}/update-password', [ ProfileController::class, 'updatePassword' ] )->name( 'profile.update-password' );
        Route::put( '{user}/update-image', [ ProfileController::class, 'updateImage' ] )->name( 'profile.update-image' );
    } );
    // Accounts
    Route::prefix( 'accounts' )->group( function () {
        Route::resource( 'customer', CustomerController::class);
        Route::post( 'customer/{customer}/update-status', [ CustomerController::class, 'updateStatus' ] )->name( 'customer.update-status' );
        Route::put( 'customer/{customer}/update-profile', [ CustomerController::class, 'updateImages' ] )->name( 'customer.update-images' );
        Route::put( 'customer/{customer}/update-password', [ CustomerController::class, 'updatePassword' ] )->name( 'customer.update-password' );

        // Seller
        Route::resource( 'user', UserController::class);
        Route::put( 'user/{user}/update-password/', [ UserController::class, 'updatePassword' ] )->name( 'user.update-password' );
        Route::post( 'user/{user}/update-status/', [ UserController::class, 'updateStatus' ] )->name( 'user.update-status' );
        Route::put( 'user/{user}/update-image/', [ UserController::class, 'updateImage' ] )->name( 'user.update-image' );
    } );
} );