<?php

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
    return view('welcome');
});

Route::get('instructions', function() {
    return view('test-instructions');
});

Route::get('average', function() {
  return view('average', ['numbers' => Numbers::generateArray()]);
});

Route::get('median', function() {
  return view('median', ['numbers' => Numbers::generateArray()]);
});

Route::get('checkMagicalHeader', function() {
    return view('welcome');
})->middleware('requireMagicalHeader');
