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
Route::get('/', [MainController::class,"MainView"]);//Главная страница
Route::get('/files/{id}',[MainController::class,"FileView"]);//Просмотр файлов

/////////////////////////////////////////////////////
require __DIR__.'/auth.php';
////////////////////////////////////////////////////
// Руты для изменения информации
Route::post('/adddepartment',[CrudController::class,"AddDepartment"]); //Добавление отедал
Route::post('/deldepartment',[CrudController::class,"DelDepartment"]); //Удаление отдела
Route::post('/upddepartment',[CrudController::class,"UpdDepartment"]); //Изменение отдела
///////////////////////////////////
Route::post('/addposition',[CrudController::class,"AddPosition"]); //Добавление должности
Route::post('/delposition',[CrudController::class,"DelPosition"]); //Удаление должности
Route::post('/updposition',[CrudController::class,"UpdPosition"]); //Изменение должности
///////////////////////////////////////////////////////////////////////
Route::post('/adduser',[CrudController::class,"AddUser"]); //Добавление пользователя
Route::post('/deluser',[CrudController::class,"DelUser"]); //Удаление пользователя
Route::post('/upduser',[CrudController::class,"UpdUser"]); //Изменение пользователя

///////////////////////
Route::post('/loadfile',[CrudController::class,"LoadFile"]); //Загрузка файлов