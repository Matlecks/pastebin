<?php

use App\Http\Controllers\PasteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComplaintController;

use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/pastes', [PasteController::class, 'index'])->name('paste.index');
Route::get('/', [PasteController::class, 'create'])->name('paste.create');
Route::post('/paste/store', [PasteController::class, 'store'])->name('paste.store');
Route::get('/pastes/{link}', [PasteController::class, 'show'])->name('paste.show');

Route::get('/auth_page', [UserController::class, 'auth_page'])->name('user.auth_page'); // страница авторзации
Route::post('/auth', [UserController::class, 'auth'])->name('user.auth'); // авторизация
Route::get('/reg_page', [UserController::class, 'reg_page'])->name('user.reg_page'); // страница регистрация
Route::post('/registrate', [UserController::class, 'registrate'])->name('user.registrate'); // регистрация

Route::get('/complaint/create', [ComplaintController::class, 'create'])->name('complaint.create'); //страница создания жалобы
Route::post('/complaint/store', [ComplaintController::class, 'store'])->name('complaint.store'); // сохранение жалобы
Route::get('/complaint/{id}', [ComplaintController::class, 'show'])->name('complaint.show'); // страница показа жалобы

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
