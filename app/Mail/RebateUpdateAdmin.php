<?php

namespace TradeInTradeUp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RebateUpdateAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $id;
    public $user;
    public $lang;

    public function __construct($sub, $mes, $subid, $user, $lang)
    {
        $this->message = $mes;
        $this->id = $subid;
        $this->user = $user;
        $this->subject = $sub;
        $this->lang = $lang;
    }

    public function build()
    {
        return $this->from('mmm-tradeup@branton.io')
            ->subject('Tool Up Rebate - '.$this->subject)
            ->view('mail.rebate-updateadmin')
            ->with('message1', $this->message)
            ->with('id', $this->id)
            ->with('user', $this->user)
            ->with('lang', $this->lang);
    }
}
