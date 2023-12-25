<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|------------------------------- -------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/posts", function (){
    return response()->json([
        "posts" => [
            [
                "title" => "post 1"
            ],
            [
                "title" => "post 2"
            ],
            [
                "title" => "post 3"
            ],
        ]
        ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/posts", function(){
    return Response()->json([
        "posts" =>[
            "name" => "brad"
        ]
        ]);
});