<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

class MailController
{
    public function mail()
    {
        $data = array('name' => 'Arunkumar');
        Mail::send('mail', $data, function ($message) {
            $message->to('atos.pontes@gmail.com', 'Arunkumar')->subject('t');
            $message->from('atos.pontes@gmail.com', 'test');
        });
        echo 'enviado';
    }
}
