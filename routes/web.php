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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('victim', 'VictimController');

Route::post('upload', 'VictimController@upload')->name('upload');

Route::post('remove', 'VictimController@remove')->name('remove');

Route::post('save_messages', 'MessageController@save')->name('save_messages');

Route::post('file_store', 'FileController@store')->name('file_store');
Route::get('file_delete/{fileId}', 'FileController@delete')->name('file_delete');

Route::get('/', function(){
    return view('front/front');
});

Route::get('/info', function(){
    return view('front/info');
});

Route::get('/mapa', function(){
    return view('front/mapa');
});

Route::post('/victimas_departamento', 'DepartmentController@victims')->name('victimas_departamento');

Route::get('create', function(){

    factory(App\User::class, 30)->create([
        'department_id' => 3
    ]);

});