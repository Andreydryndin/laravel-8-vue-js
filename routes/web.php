<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotebookController;
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

//Route::resource('notebook', NotebookController::class);
//1.1. GET /api/v1/notebook/
//1.2. POST /api/v1/notebook/
//1.3. GET /api/v1/notebook/<id>/
//1.4. POST /api/v1/notebook/<id>/
//1.5. DELETE /api/v1/notebook/<id>/
Route::get('/api/v1/notebook/', [NotebookController::class, 'index'])->name('index');
Route::post('/api/v1/notebook/', [NotebookController::class, 'store'])->name('store');
Route::get('/api/v1/notebook/{id}', [NotebookController::class, 'show'])->name('show');
Route::post('/api/v1/notebook/{id}', [NotebookController::class, 'update'])->name('update');
Route::delete('/api/v1/notebook/{id}', [NotebookController::class, 'delete'])->name('delete');

Route::post('/api/v1/upload_screen/', [NotebookController::class, 'upload_screen'])->name('upload_screen');

Route::get('/{any}',function () {
    return view('index');
})->where('any','.*');

