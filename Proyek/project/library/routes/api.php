<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('home',[App\Http\Controllers\BookController::class, 'api']);
Route::get('books',[App\Http\Controllers\BookController::class, 'api']);
Route::get('authors',[App\Http\Controllers\AuthorController::class, 'api']);
Route::get('publishers',[App\Http\Controllers\PublisherController::class, 'api']);
Route::get('taransactions',[App\Http\Controllers\TransactionController::class,'api']);
Route::get('taransactiondetails',[App\Http\Controllers\TransactionDetailController::class,'api']);
Route::get('members',[App\Http\Controllers\MemberController::class, 'api']);