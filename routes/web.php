<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('items', ItemController::class);
Route::get('ajaxEdit', [ItemController::class, 'ajaxEdit'])->name('items.ajaxEdit');
Route::post('ajaxUpdate', [ItemController::class, 'ajaxUpdate'])->name('items.ajaxUpdate');
Route::delete('ajaxDelete', [ItemController::class, 'ajaxDelete'])->name('items.ajaxDelete');
