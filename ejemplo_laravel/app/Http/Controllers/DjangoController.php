<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DjangoController extends Controller
{
    public function traer_recetas()
    {
        $response = Http::get('http://localhost:8000/api/recipes/')
            ->json();
        return response()->json($response);
    }

    public function guardar_receta(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token miclave1234',
        ])->post('http://localhost:8000/api/productos/', [
            'nombre' => $request->nombre,
            'precio' => $request->precio,
        ]);
            return [
            'status' => $response->status(),
            'body' => $response->body(),
        ];
    }


}
