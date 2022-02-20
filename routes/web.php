<?php

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

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/posts','App\Http\Controllers\PostsController');

Route::resource('/newsletters',App\Http\Controllers\NewslettersController::class);
=======
//Basic routes
Route::get('/test-route',function(){
    return "The Test Route ;";
});
Route::get('/params-route/{params?}',function($params="None"){
    return "The GET Route ; Params is :".$params;
});
Route::match(['get', 'post'], '/match-route', function () {
    return "The Match Route [ GET , POST ]";
});
Route::any('/any-route', function () {
    return "The Any Route; allowed all route methods";
});
Route::redirect('/redirect-route','/');
//Prefix route 
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return "The Prefix Route; Route is : /admin/users";
    });
});
Route::get('/test-controller');
>>>>>>> 516690930a41254a7eca96c7615957d1d6da403f
