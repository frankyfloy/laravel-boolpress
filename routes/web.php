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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/{slug}', 'PostController@show')->name('posts.show');


Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/admin/posts/dashboard', 'DashboardController@index')->name('dashboard');
        // <a href="{{route('admin.posts.dashboard')}}">Dashboard</a>
        Route::resource('posts', 'PostController');
    });
