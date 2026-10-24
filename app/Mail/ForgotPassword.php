<?php

namespace TradeInTradeUp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use TradeInTradeUp\Token;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $request;
    public $user;
    public $lang;

    public function __construct(Token $token, Request $request, $lang)
    {
        $this->user = $token->user;
        $this->token = $token;
        $this->request = $request;
        $this->lang = $lang;
    }

    public function build()
    {
        if ($this->lang == 'fr') {
            return $this->from('mmm-tradeup@branton.io')
                ->subject('Remise du programme d’échange - Réinitialiser le mot de passe')
                ->view('mail.forgot-password-fr')
                ->with('token', $this->token)
                ->with('user', $this->user)
                ->with('lang', $this->lang);
        }

        return $this->from('mmm-tradeup@branton.io')
            ->subject('Tool Up Rebate - Reset Password')
            ->view('mail.forgot-password')
            ->with('token', $this->token)
            ->with('user', $this->user)
            ->with('lang', $this->lang);
    }
}
