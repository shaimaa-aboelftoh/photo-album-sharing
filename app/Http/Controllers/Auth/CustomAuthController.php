<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoggedUsers\CustomLoginRequest;
use App\Http\Requests\LoggedUsers\CustomRegisterRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    /**
     * @param CustomLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postLoginAjax(CustomLoginRequest $request)
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return json_response(null, 'Email or password isn\'t correct !', 204);
        }
        return json_response(route('home'), 'Login Success !');
    }


    /**
     * @param CustomRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRegisterAjax(CustomRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->attachRole(2);
        auth()->login($user);
        return json_response(route('home'), 'Registered Success !');
    }
}
