<?php

namespace TradeInTradeUp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $lang;

    public function __construct($user, $lang)
    {
        $this->user = $user;
        $this->lang = $lang;
    }

    public function build()
    {
        if ($this->lang == 'fr') {
            $subject = 'Vos paramètres ont été mis à jour!';
            $message = 'Les paramètres de votre profil ont été mis à jour!';

            return $this->from('mmm-tradeup@branton.io')
                ->subject('Remise du programme d’échange - '.$subject)
                ->view('mail.update-user')
                ->with('message1', $message)
                ->with('user', $this->user)
                ->with('lang', $this->lang);
        }

        $subject = 'Your Settings Have Been Updated!';
        $message = 'Your profile settings have been updated!';

        return $this->from('mmm-tradeup@branton.io')
            ->subject('Tool Up Rebate - '.$subject)
            ->view('mail.update-user')
            ->with('message1', $message)
            ->with('user', $this->user)
            ->with('lang', $this->lang);
    }
}
