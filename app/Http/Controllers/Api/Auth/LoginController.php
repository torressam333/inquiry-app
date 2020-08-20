<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        //Validate input before requesting token access
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        //Password grant tokens using oauth token endpoint
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => 4,
            'client_secret' => 'GaKADKpgAf9dWTJxLItAteKIm6T87czXCPJulkU5',
            'username' => $request->username,
            'password' => $request->password,
        ]);

        //Returns the request object
        $requestToken = Request::create(env('APP_URL'). '/oauth/token', 'post');
        //Hit the request
        $response = Route::dispatch($requestToken);

        return $response;
    }
}
