<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Overview;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PodetaiController;


//Login
Route::get('/', [LoginController::class, 'loginform'])->name('form');
Route::post('/login', [LoginController::class, 'LoginPage'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// dashboard
Route::get('/dashboard', [Overview::class, 'dashboard']);

// userManage
Route::get('/UserManage', [UserManageController::class, 'index'])->name('usermanage');
Route::get('/UserManage', [UserManageController::class, 'GetUser'])->name('usermanage');
Route::put('update-user/{id}', [UserManageController::class,'update']);
Route::delete('delete-user/{id}', [UserManageController::class,'destroy'])->name('delete-user');
Route::post('/insert-users', [UserManageController::class,'insertUsers'])->name('insert-users');

//Category
Route::get('/Category', [CategoryController::class, 'Category'])->name('category');
Route::post('/insert-cat', [CategoryController::class, 'addCategory']);
Route::put('/edit-cat/{catid}', [CategoryController::class, 'Edit']);
Route::delete('/delete-cat/{catid}', [CategoryController::class, 'destroy'])->name('delete-cat');

//Product
Route::put('/update-pro/{id}', [ProductController::class, 'updatePro'])->name('product');
Route::delete('/delete-pro/{id}', [ProductController::class, 'DeletePro'])->name('delete-pro');
Route::get('/get-categories', [ProductController::class,'getCategories'])->name('get-categories');
Route::get('/product', [ProductController::class, 'Product'])->name('product');
Route::post('/insert-pro', [ProductController::class, 'AddProduct'])->name('insert-pro');

// Purchase
Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
Route::post('/create', [PurchaseController::class, 'create'])->name('create');
Route::post('/purchase_edit', [PurchaseController::class, 'Purchase_edit'])->name('Purchase_edit');
Route::post('/searchpro', [ProductController::class, 'searchProduct'])->name('product.search');

// Report
Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::get('/search-reports', [ReportController::class,'searchReports'])->name('search-reports');
Route::delete('/delete-rep/{id}', [ReportController::class, 'delete'])->name('delete-rep');
Route::put('/update-rep/{id}', [ReportController::class,'updateRep'])->name('update-rep');

// Product Details

Route::get('/get-prodetail/{poid}', [PodetaiController::class,'getProdetail'])->name('get-prodetail');



//Users
Route::get('/customer', [UMController::class, 'User'])->name('customer');
Route::post('/adduser', [UMController::class, 'AddUser']);
Route::post('/delete', [UMController::class, 'Delete']);
Route::post('/update', [UMController::class, 'Update']);





