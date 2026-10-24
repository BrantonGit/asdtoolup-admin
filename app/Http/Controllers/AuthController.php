<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use TradeInTradeUp\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response('User does not exist', 422);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response('Password mismatch', 422);
        }

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response(['token' => $token], 200);
    }
}
