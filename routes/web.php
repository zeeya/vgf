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

$front_routes = realpath(__DIR__).DIRECTORY_SEPARATOR.'front_routes'.DIRECTORY_SEPARATOR;



/********** auth for user ***********/
Auth::routes();


/********** end auth for user ***********/


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/********** Return_request *************/
include_once($front_routes .'Return_request.php');



