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

// #Auth：ルート
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

// #インシデント：ルート
Route::group(['middleware' => ['auth']], function(){
    // Route::get('incidents/detail/{id}', 'App\Http\Controllers\IncidentController@detail')->name('incidents.detail');
    Route::match(['get', 'post'], 'incidents/detail/{id}', 'App\Http\Controllers\IncidentController@detail')->name('incidents.detail');
    Route::post('incidents/store', 'App\Http\Controllers\IncidentController@store')->name('incidents.store');
    Route::get('incidents', 'App\Http\Controllers\IncidentController@index')->name('incidents.index');
    Route::get('incidents/new', 'App\Http\Controllers\IncidentController@new')->name('incidents.new');
// Route::get('incidents/edit', 'App\Http\Controllers\IncidentController@edit')->name('incidents.edit');
    Route::post('incidents/destroy', 'App\Http\Controllers\IncidentController@destroy')->name('incidents.destroy');
// Route::post('incidents/update', 'App\Http\Controllers\IncidentController@update')->name('incidents.update');


// #マニュアル：ルート
    Route::get('manuals/detail/{id}', 'App\Http\Controllers\ManualController@detail')->name('manuals.detail');
    Route::post('manuals/store', 'App\Http\Controllers\ManualController@store')->name('manuals.store');
    Route::get('manuals', 'App\Http\Controllers\ManualController@index')->name('manuals.index');
    Route::get('manuals/new', 'App\Http\Controllers\ManualController@new')->name('manuals.new');
    Route::post('manuals/destroy', 'App\Http\Controllers\ManualController@destroy')->name('manuals.destroy');

    // #マニュアル：動画：配信
    Route::get('manuals/video/stream', 'App\Http\Controllers\ManualController@stream')->name('manuals.stream');
    
    // #マニュアル：動画：アップロード
    // Route::form('manuals/video/upload', 'App\Http\Controllers\ManualController@upload')->name('manuals.upload');

});



