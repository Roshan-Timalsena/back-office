<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StaffController;
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

Route::get('/', function () {
    return redirect('/login');
});

//Bills Routes
Route::get('/dashboard', function(){
    return redirect('/staffs');
});
Route::get('/bill/add', [BillController::class, 'index'])->middleware(['auth'])->name('bill.new');
Route::post('/bill/add', [BillController::class, 'store'])->middleware(['auth'])->name('bill.add');

Route::get('/bills', [BillController::class, 'allBills'])->middleware(['auth'])->name('bill.all');

Route::get('/bill/update/{bill:id}', [BillController::class, 'getSingleBill'])->middleware(['auth'])->name('bill.get.update');
Route::post('/bill/update/{bill:id}', [BillController::class, 'updatebill'])->middleware(['auth'])->name('bill.update');

Route::get('/bill/remove/{bill:id}', [BillController::class , 'softDeleteBill'])->middleware('auth')->name('bill.remove');

Route::get('/bills/trash', [BillController::class, 'getTrashed'])->middleware(['auth'])->name('bill.trash');
Route::get('/bill/restore/{id}', [BillController::class, 'restore'])->middleware(['auth'])->name('bill.restore');
Route::get('/bill/delete/{id}', [BillController::class, 'delete'])->middleware(['auth'])->name('bill.delete');
//Bills Routes End

//Staff Route Starts
Route::get('/staffs', [StaffController::class, 'index'])->middleware(['auth'])->name('staff.all');

Route::get('/staff/add', [StaffController::class, 'addStaff'])->middleware(['auth'])->name('staff.new');

Route::post('/staff/add', [StaffController::class, 'store'])->middleware(['auth'])->name('staff.add');

Route::get('/staff/update/{user:id}',[StaffController::class, 'getSingleStaff'])->middleware(['auth'])->name('staff.single');
Route::post('/staff/update/{user:id}', [StaffController::class, 'updateStaff'])->middleware(['auth'])->name('staff.update');
//Staff Route Ends

//Documents Route Starts
Route::get('/documents', [DocumentController::class, 'index'])->middleware(['auth'])->name('docs.all');

Route::get('document/add', [DocumentController::class, 'addDocs'])->middleware(['auth'])->name('docs.new');
Route::post('document/add', [DocumentController::class, 'store'])->middleware(['auth'])->name('docs.add');
Route::post('/document/drop', [DocumentController::class, 'docStore'])->middleware(['auth'])->name('docs.drop');

Route::get('/document/update/{document:id}', [DocumentController::class, 'getSingleDoc'])->middleware(['auth'])->name('docs.single');
Route::post('/document/update/{document:id}', [DocumentController::class, 'updateDoc'])->middleware(['auth'])->name('docs.update');

Route::get('/document/remove/{document:id}', [DocumentController::class, 'remove'])->middleware(['auth'])->name('docs.remove');

Route::get('/document/restore/{id}', [DocumentController::class, 'restoreDocs'])->middleware(['auth'])->name('docs.restore');

Route::get('document/delete/{id}', [DocumentController::class, 'deleteDocs'])->middleware(['auth'])->name('docs.delete');

Route::get('/documents/trash', [DocumentController::class, 'getDocsTrash'])->middleware(['auth'])->name('docs.trash');
//Document Route Ends

//Products Route starts
Route::get('/products',[ProductsController::class, 'index'])->middleware(['auth'])->name('products.all');

Route::get('/product/add',[ProductsController::class, 'addProduct'])->middleware(['auth'])->name('prod.new');
Route::post('/product/drop', [ProductsController::class,'prodStore'])->middleware(['auth'])->name('prod.drop');
Route::post('/product/add',[ProductsController::class, 'store'])->middleware(['auth'])->name('prod.add');

Route::get('/product/update/{product:id}', [ProductsController::class,'getSingleProduct'])->middleware(['auth'])->name('prod.single');
Route::post('/products/update/{product:id}', [ProductsController::class, 'updateProduct'])->middleware(['auth'])->name('prod.update');

Route::get('product/remove/{product:id}',[ProductsController::class, 'remove'])->middleware(['auth'])->name('prod.remove');

Route::get('product/trash', [ProductsController::class, 'getProductsTrash'])->middleware(['auth'])->name('prod.trash');

Route::get('prodcut/restore/{id}',[ProductsController::class, 'restoreProduct'])->middleware(['auth'])->name('prod.restore');

Route::get('prodcut/delete/{id}', [ProductsController::class, 'deleteProduct'])->middleware(['auth'])->name('prod.delete');
require __DIR__.'/auth.php';
