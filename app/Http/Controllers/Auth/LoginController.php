<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getToken(Request $request)
    {
        //Password grant tokens using oauth token endpoint
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => 4,
            'client_secret' => '5EKTXiXGKlwZUvoHfZCg8MUVE79TPqG27C6vsxwq',
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
