<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

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


Route::get('/categories', [ApiController::class, 'categories']);
Route::get('/get-category/{category_type}', [ApiController::class, 'getCategory']);
Route::get('/category-details/{id}', [ApiController::class,'categoryDetails']);
Route::get('/tips', [ApiController::class, 'tips']);