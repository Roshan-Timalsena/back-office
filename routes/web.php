<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\StaffController;
use App\Models\Bill;
use Illuminate\Support\Facades\Route;
use PhpParser\Comment\Doc;

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

Route::get('/dashboard', [BillController::class, 'allBills'])->middleware(['auth'])->name('bill.form');
Route::get('/bill/add', [BillController::class, 'index'])->middleware(['auth'])->name('bill.new');
Route::post('/add', [BillController::class, 'store'])->middleware(['auth'])->name('bill.add');

Route::get('/bills', [BillController::class, 'allBills'])->middleware(['auth'])->name('bill.all');

Route::get('/bill/update/{bill:id}', [BillController::class, 'getSingleBill'])->middleware(['auth'])->name('bill.get.update');
Route::post('/bill/update/{bill:id}', [BillController::class, 'updatebill'])->middleware(['auth'])->name('bill.update');

Route::get('/bill/remove/{bill:id}', [BillController::class , 'softDeleteBill'])->middleware('auth')->name('bill.remove');

Route::get('/bills/trash', [BillController::class, 'getTrashed'])->middleware(['auth'])->name('bill.trash');

Route::get('/bill/restore/{id}', [BillController::class, 'restore'])->middleware(['auth'])->name('bill.restore');

Route::get('/bill/delete/{id}', [BillController::class, 'delete'])->middleware(['auth'])->name('bill.delete');

Route::get('/staffs', [StaffController::class, 'index'])->middleware(['auth'])->name('staff.all');

Route::get('/staff/add', [StaffController::class, 'addStaff'])->middleware(['auth'])->name('staff.new');

Route::post('/staff/add', [StaffController::class, 'store'])->middleware(['auth'])->name('staff.add');

Route::get('/documents', [DocumentController::class, 'index'])->middleware(['auth'])->name('docs.all');

Route::get('document/add', [DocumentController::class, 'addDocs'])->middleware(['auth'])->name('docs.new');
Route::post('document/add', [DocumentController::class, 'store'])->middleware(['auth'])->name('docs.add');
ROute::post('/document/drop', [DocumentController::class, 'docStore'])->middleware(['auth'])->name('docs.drop');

require __DIR__.'/auth.php';
