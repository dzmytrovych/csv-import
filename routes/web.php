<?php

use App\Http\Controllers\ImportController;
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

Route::get('/', [ImportController::class, 'index'])->name('index');
Route::post('/mapping', [ImportController::class, 'mapping'])->name('mapping');
Route::post('/preview', [ImportController::class, 'preview'])->name('preview');
Route::post('/save', [ImportController::class, 'save'])->name('save');
