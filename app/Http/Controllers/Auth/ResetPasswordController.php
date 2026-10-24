<?php

namespace TradeInTradeUp\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use TradeInTradeUp\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'https://fulfillments.branton.ca/asdtoolup/login';

    /**
     * Display the password reset view for the given token.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Reset the given user's password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            if ($request->expectsJson()) {
                return response()->json(['status' => 'Password reset successfully.']);
            }

            return redirect($this->redirectTo)->with('status', 'Your password has been reset!');
        }

        if ($request->expectsJson()) {
            return response()->json(['email' => 'This password reset token is invalid.'], 422);
        }

        return back()->withErrors([
            'email' => 'This password reset token is invalid.',
        ])->onlyInput('email');
    }
}
