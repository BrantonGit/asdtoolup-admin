<?php

namespace TradeInTradeUp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToggleEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $on;
    public $user;
    public $lang;

    public function __construct($on, $user, $lang)
    {
        $this->on = $on;
        $this->user = $user;
        $this->lang = $lang;
    }

    public function build()
    {
        if ($this->lang == 'fr') {
            if ($this->on == 1) {
                $subject = 'Vos notifications par courriel ont été activées';
                $message1 = 'Vous avez activé vos notifications par courriel!';
                $message2 = 'Vous recevrez désormais des notifications par courriel concernant la mise à jour ou la révision de vos remises d’achat.';
            } else {
                $subject = 'Vos notifications par courriel ont été désactivées';
                $message1 = 'Vous avez désactivé vos notifications par courriel!';
                $message2 = 'Vous ne recevrez plus de notifications par courriel concernant la mise à jour ou la révision de vos remises d’achat.';
            }

            $message3 = 'Si vous souhaitez modifier vos préférences, réglez les paramètres de votre profil du programme d’échange.';

            return $this->from('mmm-tradeup@branton.io')
                ->subject('Remise du programme d’échange - '.$subject)
                ->view('mail.notifications-toggle')
                ->with('message1', $message1)
                ->with('message2', $message2)
                ->with('message3', $message3)
                ->with('user', $this->user)
                ->with('lang', $this->lang);
        }

        if ($this->on == 1) {
            $subject = 'Your Email Notifications Have Been Turned On';
            $message1 = 'You have turned on your email notifications!';
            $message2 = 'You will now receive email notifications about your rebates being updated or reviewed.';
        } else {
            $subject = 'Your Email Notifications Have Been Turned Off';
            $message1 = 'You have turned off your email notifications!';
            $message2 = 'You will no longer receive email notifications about your rebates being updated or reviewed.';
        }

        $message3 = 'If you wish to change your notification preferences, adjust your Trade in, Tool Up profile settings.';

        return $this->from('mmm-tradeup@branton.io')
            ->subject('Tool Up Rebate - '.$subject)
            ->view('mail.notifications-toggle')
            ->with('message1', $message1)
            ->with('message2', $message2)
            ->with('message3', $message3)
            ->with('user', $this->user)
            ->with('lang', $this->lang);
    }
}
