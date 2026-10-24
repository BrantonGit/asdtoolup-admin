<?php

namespace TradeInTradeUp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use TradeInTradeUp\User;

class RebateUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $id;
    public $user;
    public $lang;

    public function __construct($sub, $mes, $subid, User $user, $lang)
    {
        $this->message = $mes;
        $this->id = $subid;
        $this->user = $user;
        $this->subject = $sub;
        $this->lang = $lang;
    }

    public function build()
    {
        if ($this->lang == 'fr') {
            return $this->from('mmm-tradeup@branton.io')
                ->subject('Remise du programme d’échange - '.$this->subject)
                ->view('mail.rebate-update-fr')
                ->with('message1', $this->message)
                ->with('id', $this->id)
                ->with('user', $this->user)
                ->with('lang', $this->lang);
        }

        return $this->from('mmm-tradeup@branton.io')
            ->subject('Tool Up Rebate - '.$this->subject)
            ->view('mail.rebate-update')
            ->with('message1', $this->message)
            ->with('id', $this->id)
            ->with('user', $this->user)
            ->with('lang', $this->lang);
    }
}
