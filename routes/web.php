<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('index');
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('about');
// contact
Route::get('/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');
// Loan
Route::get('/apply', [App\Http\Controllers\LoanController::class, 'apply'])->name('apply');
// Login
Route::get('/userlogin', [App\Http\Controllers\Auth\LoginController::class, 'userlogin'])->name('userlogin');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
