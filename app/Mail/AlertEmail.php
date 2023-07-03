<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * @param $data
     */

    public function __construct($data)
    {
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->title = 'Alerta Email';
        $data = $this->data;
        $mailTo = env('MAIL_ADM');

        return $this->view('email.alert_email')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->with('data', $data)
            ->to($mailTo);
    }

}
