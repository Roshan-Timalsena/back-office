<?php

use App\Http\Controllers\BillController;
use App\Models\Bill;
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
    return redirect('/register');
});

Route::get('/dashboard', [BillController::class, 'index'])->middleware(['auth'])->name('bill.form');
Route::post('/add', [BillController::class, 'store'])->middleware(['auth'])->name('bill.add');

Route::get('/bills', [BillController::class, 'allBills'])->middleware(['auth'])->name('bill.all');

Route::get('/bill/update/{bill:id}', [BillController::class, 'getSingleBill'])->middleware(['auth'])->name('bill.get.update');
Route::post('/bill/update', [BillController::class, 'updatebill'])->middleware(['auth'])->name('bill.update');

Route::get('/bill/remove/{bill:id}', [BillController::class , 'softDeleteBill'])->middleware('auth')->name('bill.remove');

Route::get('/bill/trash', [BillController::class, 'getTrashed'])->middleware(['auth'])->name('bill.trash');

Route::get('/bill/restore/{id}', [BillController::class, 'restore'])->middleware(['auth'])->name('bill.restore');

Route::get('/bill/delete/{id}', [BillController::class, 'delete'])->middleware(['auth'])->name('bill.delete');


require __DIR__.'/auth.php';
