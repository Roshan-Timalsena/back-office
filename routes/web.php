<?php

use App\Http\Controllers\BillController;
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

require __DIR__.'/auth.php';
