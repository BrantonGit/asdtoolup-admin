<?php

namespace TradeInTradeUp\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use TradeInTradeUp\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'We have e-mailed your password reset link!');
        }

        return back()->withErrors([
            'email' => 'We can\'t find a user with that e-mail address.',
        ])->onlyInput('email');
    }
}
