<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'time',
    ];

    public function ingredientRecipes()
    {
        return $this->hasMany(IngredientRecipe::class, 'id_recipe');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recipes', 'id_recipe', 'id_ingredient')
            ->withPivot('quantity', 'description')
            ->withTimestamps();
    }
}
