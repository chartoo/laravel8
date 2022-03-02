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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/posts','App\Http\Controllers\PostsController');

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

/*
* make Event and Listener Notification
*/

Route::resource('/newsletters',App\Http\Controllers\NewslettersController::class);

Route::get('/notify/newsletters',[App\Http\Controllers\NewslettersController::class,'notify']);

/*
* make Broadcasting Channel Notification
*/

Route::get('/make-event',[App\Http\Controllers\MessageNotificationsController::class,'make_event'])->name('make-event');
Route::post('/send-make-event',[App\Http\Controllers\MessageNotificationsController::class,'send_make_event'])->name('send-make-event');
Route::get('/listen-event',[App\Http\Controllers\MessageNotificationsController::class,'listen_event'])->name('listen-event');

/*
* Private Chat Message
*/
Route::resource('/chat-private-messages',App\Http\Controllers\ChatPrivateMessageController::class)->middleware('auth');
Route::resource('/chat-rooms',App\Http\Controllers\ChatRoomController::class)->middleware('auth');
Route::post('/chat/{user_code}/{room_code}',[App\Http\Controllers\ChatRoomController::class,'entry'])->middleware('auth');

Route::get('/migrate',function(){
    Artisan::call('migrate --force');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return route('/');
});