<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientRecipe extends Model
{
    protected $table = 'ingredient_recipes';

    protected $fillable = [
        'id_recipe',
        'id_ingredient',
        'quantity',
        'description',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'id_recipe');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'id_ingredient');
    }
}
