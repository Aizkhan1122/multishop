<?php

use Illuminate\Support\Facades\Route;

// ================= FRONTEND CONTROLLERS =================
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\SettingsController;
// use App\Http\Controllers\InvoiceController;

// ================= ADMIN CONTROLLERS =================
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
// use App\Http\Controllers\Admin\AdminController;  


// -----------------------------
// Public Pages
// -----------------------------
// Root route - redirect to home
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');
// use App\Http\Controllers\Admin\CategoryController;
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::get('/detail', function () {
    return view('detail');
});


// ================= ADMIN ROUTES =================
Route::prefix('admin')->group(function () {
    // Guest routes (login & register)
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::resource('categories', AdminCategoryController::class);
   
   
    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
         Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
         
        //  from chatgpt
          // Profile Page (GET)
         Route::get('/profile', [AdminSettingsController::class, 'profile'])->name('admin.profile');

        // Update Site Settings
         Route::post('/profile/site-settings', [AdminSettingsController::class, 'updateSiteSettings'])->name('admin.site-settings.update');

         // Update Admin Profile
        Route::put('/profile', [AdminSettingsController::class, 'updateProfile'])->name('admin.profile.update');

         // Update Password
        Route::put('/profile/password', [AdminSettingsController::class, 'updatePassword'])->name('admin.password.update');

         // Delete Admin Account
         Route::delete('/profile', [AdminSettingsController::class, 'destroy'])->name('admin.delete');
        

        // Users, Orders, Admins
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create',[AdminUserController::class, 'create'])->name('admin.users.create'); 
        Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        
        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}',[AdminOrderController::class, 'show'])->name('admin.orders.show'); 
        Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');

        // Settings
        Route::get('/settings', [AdminSettingsController::class, 'settings'])->name('admin.settings.index');
        // Route::post('/settings', [AdminSettingsController::class, 'update'])->name('admin.settings.update');
        
        // Invoices
        Route::get('/invoices', [AdminInvoiceController::class, 'index'])->name('admin.invoices.index');
        Route::get('/invoices/{order}', [AdminInvoiceController::class, 'show'])->name('admin.invoices.show');
        Route::get('/invoices/{order}/download', [AdminInvoiceController::class, 'download'])->name('admin.invoices.download');
        
        // Test Icons Route
        Route::get('/test-icons', function () {
            return view('admin.test-icons');
        })->name('admin.test.icons');
        
        
        // Route::get('/admin', [AdminAuthController::class, 'index'])->name('admin.dashboard');
    });
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// -----------------------------
// Products
// -----------------------------
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// -----------------------------
// Categories
// -----------------------------
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');


// -----------------------------
// Cart
// -----------------------------
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// -----------------------------
// Wishlist
// -----------------------------
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// -----------------------------
// Orders
// -----------------------------
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// -----------------------------
// Order Items
// -----------------------------
Route::get('/order-items', [OrderItemController::class, 'index'])->name('order-items.index');

// -----------------------------
// Users
// -----------------------------
Route::get('/users', [UserController::class,'index'])->name('users.index');

// -----------------------------
// log in
// -----------------------------
Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin');
Route::post('/signin', [AuthController::class, 'login']);

// -----------------------------
// logout
// -----------------------------
Route::get('/signup', [AuthController::class, 'showRegisterForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__.'/admin.php';