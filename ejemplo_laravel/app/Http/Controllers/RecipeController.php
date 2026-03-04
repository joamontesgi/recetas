<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('ingredients')->get();
        return response()->json($recipes);
    }

    public function show($id)
    {
        $recipe = Recipe::with('ingredients')->findOrFail($id);
        return response()->json($recipe);
    }

    public function store(StoreRecipeRequest $request)
    {
        $data = $request->only(['name', 'time']);
        $recipe = Recipe::create($data);

        if ($request->has('ingredients')) {
            $attach = [];
            foreach ($request->input('ingredients') as $ing) {
                $attach[$ing['id']] = [
                    'quantity' => $ing['quantity'],
                    'description' => $ing['description'] ?? null,
                ];
            }
            $recipe->ingredients()->attach($attach);
        }

        return response()->json($recipe->load('ingredients'), 201);
    }

    public function update(UpdateRecipeRequest $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->only(['name', 'time']));

        if ($request->has('ingredients')) {
            $sync = [];
            foreach ($request->input('ingredients') as $ing) {
                $sync[$ing['id']] = [
                    'quantity' => $ing['quantity'],
                    'description' => $ing['description'] ?? null,
                ];
            }
            $recipe->ingredients()->sync($sync);
        }

        return response()->json($recipe->load('ingredients'));
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->ingredients()->detach();
        $recipe->delete();
        return response()->json(['message' => 'Eliminado']);
    }
}
