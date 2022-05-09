<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', [IndexController::class, 'show']);
Route::post('/', [IndexController::class, 'add'])->name('add');
Route::post('/update', [IndexController::class, 'update'])->name('update');
Route::post('/delate', [IndexController::class, 'delete'])->name('delete');




Route::get('/db-test', function (){
    try {
        DB::connection()->getPDO();
        echo 'Nazwa: ' . DB::connection()->getDatabaseName();
    } catch (Exception $e) {
        echo 'None' . $e;
    }
});
