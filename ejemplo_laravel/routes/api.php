<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DjangoController;
use App\Http\Controllers\FlaskController;
use App\Http\Controllers\ExpressController;
use Illuminate\Support\Facades\Http;

Route::post('/recetas_django', [DjangoController::class, 'guardar_receta'])->middleware('auth:sanctum');


Route::get('/recetas_django', [DjangoController::class, 'traer_recetas']);
Route::get('/usuarios_firebase', [ExpressController::class, 'usuarios_firebase']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/password_reset', [UserController::class, 'password_reset']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::get("/ingredients",[IngredientController::class, "index"])->middleware('auth:sanctum');
Route::post("/ingredients",[IngredientController::class, "store"]);
Route::put("/ingredients/{id}",[IngredientController::class, "update"]);
Route::delete("/ingredients/{id}",[IngredientController::class, "destroy"]);
Route::apiResource('recipes', RecipeController::class);

Route::any('/prueba', function (){
    return redirect('https://fakestoreapi.com/products');
});

Route::get('/prueba_dos', function (){
    return
    $response = Http::get('https://fakestoreapi.com/products')
    ->json();
});



