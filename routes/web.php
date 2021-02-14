<?php

use Illuminate\Support\Facades\Route;

use Faker\Factory as Faker;
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

Route::group(['middleware' => ['auth']], function() {
    Route::get('register/edit/{user_id}', 'Auth\RegisterController@edit');
    Route::put('register/{user_id}', 'Auth\RegisterController@update')->name('register.user');

    Route::get('delete/{id}', function($id){

        if(Auth::user()->admin == 1)
        {
            if(Auth::user()->id != $id){
                App\File::where('user_id', $id)->delete();
                App\User::destroy($id);
                
            }
            
        }

        return redirect('/');
        

    })->name('delete');
});

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('victim', 'VictimController');

Route::post('upload', 'VictimController@upload')->name('upload');
    
Route::post('remove', 'VictimController@remove')->name('remove');

Route::post('save_messages', 'MessageController@save')->name('save_messages');

Route::post('file_store', 'FileController@store')->name('file_store');
Route::get('file_delete/{fileId}', 'FileController@delete')->name('file_delete');


Route::get('/', function(){
    $user = \App\User::latest()->first();

    return view('front/front', compact('user'));
});

Route::get('/info', function(){
    return view('front/info');
});

Route::get('/mapa', function(){
    return view('front/mapa');
});

Route::post('/victimas_departamento', 'DepartmentController@victims')->name('victimas_departamento');
Route::get('/victim/{victim_id}', 'VictimController@show');

Route::get('create', function(){
    // $faker = Faker::create();
    // factory(App\User::class, 30)->create([
    //     'department_id' => 3,
    //     'name_victim' => $faker->name,
    //     'last_name_victim' => $faker->last_name,
    // ]);


    $faker = Faker::create();
    	foreach (range(1,20) as $index) {
	        \DB::table('users')->insert([
	            'name' => $faker->name,
                'email' => $faker->email,
                'department_id' => 14,
                'name_victim' => $faker->firstName,
                'last_name_victim' => $faker->lastName,
	            'password' => bcrypt('secret'),
	        ]);
    }
    



});