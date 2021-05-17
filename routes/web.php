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
Route::post('/post-data',function (\Illuminate\Http\Request $request){
    dd($request->all());
})->name('post-data');
Route::post('/post-data-ajax',function (\Illuminate\Http\Request $request){
    dd($request->all());
})->name('post-data-ajax');

Route::post('/verifiedOTP',[\App\Http\Controllers\OTPController::class , 'verify'])->name('verify');

Route::get('/verifyOTP',[\App\Http\Controllers\OTPController::class,'showVerifyForm']);


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth','TwoFa'])->name('dashboard');



require __DIR__.'/auth.php';
