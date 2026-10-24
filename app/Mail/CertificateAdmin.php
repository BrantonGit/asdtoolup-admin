<?php

namespace TradeInTradeUp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $id;
    public $rebatevalue;
    public $country;
    public $email;
    public $user;
    public $lang;

    public function __construct($sub, $mes, $certid, $rebatevalue, $country, $email, $user, $lang)
    {
        $this->message = $mes;
        $this->id = $certid;
        $this->rebatevalue = $rebatevalue;
        $this->country = $country;
        $this->email = $email;
        $this->user = $user;
        $this->subject = $sub;
        $this->lang = $lang;
    }

    public function build()
    {
        return $this->from('mmm-tradeup@branton.io')
            ->subject('Tool Up Rebate - '.$this->subject)
            ->view('mail.certificate-admin')
            ->with('message1', $this->message)
            ->with('id', $this->id)
            ->with('email', $this->email)
            ->with('rebatevalue', $this->rebatevalue)
            ->with('country', $this->country)
            ->with('user', $this->user)
            ->with('lang', $this->lang);
    }
}
