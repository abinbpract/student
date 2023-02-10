<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
Route::resource('students',StudentController::class);
// Route::resource('employees',EmployeeController::class);
// Route::get('contact',function(){
//     $a=10;
// });
// Route::get('about',function(){
//     $b=5;
// });
// Route::get('info',function(){
//     $c=6;
// });
// Route::get('business',function(){
//     $e=9;
// });
// Route::get('other',function(){
//     $d=7;
// });