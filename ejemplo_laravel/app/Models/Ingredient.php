<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
    ];

    public function ingredientRecipes()
    {
        return $this->hasMany(IngredientRecipe::class, 'id_ingredient');
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipes', 'id_ingredient', 'id_recipe')
            ->withPivot('quantity', 'description')
            ->withTimestamps();
    }
}
