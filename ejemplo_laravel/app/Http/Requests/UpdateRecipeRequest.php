<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'time' => 'sometimes|required|string|max:50',
            'ingredients' => 'array',
            'ingredients.*.id' => 'required_with:ingredients|exists:ingredients,id',
            'ingredients.*.quantity' => 'required_with:ingredients|numeric',
            'ingredients.*.description' => 'nullable|string',
        ];
    }
}
