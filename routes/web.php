<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcCategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShowCategoryController;
use App\Http\Controllers\ShowProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


Route::get('/admins', action: function () {
    return view('admin/index');
});
 
Route::get('/add_category', [CategoryController::class, 'add'])->name('add.category');
Route::post('/creat_category', [CategoryController::class, 'insert'])->name('creat.category');
Route::get('/categories_list', [CategoryController::class, 'view_cat'])->name('category.list');
Route::get('/update_category/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::put('/edit_category/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::delete('/categories_list/{id}', [CategoryController::class, 'destroy'])->name('delete.category');


Route::get('/add_subcategory', [SubcCategoryController::class, 'add'])->name('add.subcategory');
Route::post('/creat_subcategory', [SubcCategoryController::class, 'insert'])->name('creat.subcategory');
Route::get('/subcategories_list', [SubcCategoryController::class, 'view_subcat'])->name('subcategory.list');
Route::get('/update_subcategory/{id}', [SubcCategoryController::class, 'update'])->name('update.subcategory');
Route::put('/edit_subcategory/{id}', [SubcCategoryController::class, 'edit'])->name('edit.subcategory');
Route::delete('/subcategories_list/{id}', [SubcCategoryController::class, 'destroy'])->name('delete.subcategory');


Route::get('/add_product', [ProductsController::class, 'add'])->name('add.product');
Route::post('/creat_product', [ProductsController::class, 'insert'])->name('creat.product');
Route::get('/products_list', [ProductsController::class, 'view_pro'])->name('product.list');
Route::get('/update_product/{id}', [ProductsController::class, 'update'])->name('update.product');
Route::put('/edit_product/{id}', [ProductsController::class, 'edit'])->name('edit.product');
Route::delete('/products_list/{id}', [ProductsController::class, 'destroy'])->name('delete.product');
Route::post('/get-subcategories', [ProductsController::class, 'getSubcategories']);


// home routes

// Route::get('/', action: function () {
//     return view('/index');
// });

Route::get('/', [ShowCategoryController::class, 'showCategory']);
Route::get('/shop', [ShowProductsController::class,'showProducts'] )->name('show.shop');
Route::get('/shop_single/{id}', [ShowProductsController::class,'showSingleProduct'] )->name('show.singleshop');
Route::post('/cart', [CartController::class,'addToCart'] )->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::get('/checkout', function () {
    return view('checkout');
});
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/stripe', [CheckoutController::class, 'stripe'])->name('checkout.stripe');
Route::post('/stripe/charge', [CheckoutController::class, 'charge'])->name('checkout.charge');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');




Route::get('/about', action: function () {
    return view('/about');
});


Route::get('/contact', action: function () {
    return view(view: '/contact');
});
