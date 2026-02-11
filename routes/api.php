<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientController;

Route::get("/ingredients",[IngredientController::class, "index"]);
Route::post("/ingredients",[IngredientController::class, "store"]);
Route::put("/ingredients/{id}",[IngredientController::class, "update"]);
Route::delete("/ingredients/{id}",[IngredientController::class, "destroy"]);




