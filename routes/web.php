<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CrudController;

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
// Вывод вью составляющих
Route::get('/', [MainController::class,"MainView"]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Руты для изменения информации
Route::post('/adddepartment',[CrudController::class,"AddDepartment"]); //Добавление отедал
Route::post('/deldepartment',[CrudController::class,"DelDepartment"]); //Удаление отдела
Route::post('/upddepartment',[CrudController::class,"UpdDepartment"]); //Изменение отдела
