<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/tokenMe', function (){
    return csrf_token();
});

Auth::routes();
Route::get('/', function()
{
    return Redirect::to( '/home');
    // OR: return Redirect::intended('/bands'); // if using authentication
});
Route::get('{any}', function (){
    return view('vue-home');
})->name('any_index')->where('any', '.*');
