<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExpressController extends Controller
{
public function usuarios_firebase()
{
    $response = Http::withHeaders([
        'Authorization' => 'miclave123',
    ])->get('http://localhost:3000/users/');
    return [
        'status' => $response->status(),
        'body' => $response->body(),
    ];
}
}
