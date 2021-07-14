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

Route::middleware( 'auth:sanctum' )->get( '/user', function ( Request $request ) {
    return $request->user();
} );


Route::apiResource( 'projects', '\App\Http\Controllers\Api\ProjectController' );
Route::get('project-ids', [\App\Http\Controllers\Api\ProjectController::class, 'ids']);
Route::post('projects/{project}/add-view', [\App\Http\Controllers\Api\ProjectController::class, 'addView']);
