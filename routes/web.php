<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('contacts', ContactController::class);
