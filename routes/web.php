<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use GuzzleHttp\Middleware;

// Common resource route
// index - show all listings
// show - show all listing
// create - show form to create listing
// store - store listing
// edit - edit listing
// update - update listing
// destory - delete listing

//get all listing (with filtering functionalty)
Route::get("/", [ListingController::class,"index"]);

// route to show page to create new listing
Route::get("/listings/create",[ListingController::class, "create"])->middleware("auth"); 

// route to store listing
Route::post("/listings",[ListingController::class, "store"])->middleware("auth");

// route to get a single listing for updating
Route::get("/listings/{listing}/edit", [ListingController::class, "edit"])->middleware("auth");

// route to get a update listing
Route::put("/listings/{listing}", [ListingController::class, "update"])->middleware("auth");

// route to get a update listing
Route::delete("/listings/{listing}", [ListingController::class, "delete"])->middleware("auth");

// manage listing
Route::get("/listings/manage",[ListingController::class, "manage"])->Middleware("auth");

// route to get a single listing
Route::get("/listings/{listing}", [ListingController::class, "show"]);


// show register create form ...
Route::get("/register",[UserController::class,"create"])->middleware("guest");

// create and login user ..
Route::post("/users",[UserController::class,"store"])->middleware("guest");

// logout user
Route::post("/logout",[UserController::class,"logout"])->middleware("auth");

// show login form user
Route::get("/login",[UserController::class,"login"])->name("login")->middleware("guest");

// login user
Route::post("/users/authenticate", [UserController::class, "authenticate"]);




