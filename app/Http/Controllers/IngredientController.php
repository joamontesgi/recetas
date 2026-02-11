<?php

namespace App\Http\Controllers;
use App\Models\Ingredient;

use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(){
        $ingredients= Ingredient::all();
        return response()->json($ingredients);
    }
    public function store(Request $request){
        $ingredient=new Ingredient();
        $ingredient->name=$request->name;
        $ingredient->save();
        return response()->json($ingredient);
    }
    public function update(Request $request,$id){
        $ingredient=Ingredient::find($id);
        $ingredient->name=$request->name;
        $ingredient->save();
        return response()->json($ingredient);
    }
    public function destroy($id){
        $ingredient=Ingredient::find($id);
        $ingredient->delete();
        return response()->json("Eliminado");
    }

}
